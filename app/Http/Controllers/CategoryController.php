<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Utils\Constant;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class CategoryController extends Controller
{
    /**
     * Index Wallet page
     */
    public function index()
    {
        $data['sidebar'] = 'category';
        return view('pages.master.category',$data);
    }

    /**
     * Add Wallet page
     */
    public function add()
    {
        $data['sidebar'] = 'category';
        $data['title']   = 'Tambah';
        $data['model']   = Category::class;
        $data['mode']    = '';
        return view('pages.master.detail-category',$data);
    }

    /**
     * Detail (edit,detail) Wallet page
     * @param id of the wallet and mode (edit or detail)
     */
    public function detail($id,$mode)
    {
        $data['sidebar'] = 'category';
        $data['title']   = Constant::COMMON_MODE_LIST[$mode];
        $data['model']   = Category::find($id);
        $data['mode']    = $mode;
        if(empty($data['model']) || !in_array($mode,[Constant::COMMON_MODE_EDIT,Constant::COMMON_MODE_DETAIL])) {
            abort(404);
        }
        return view('pages.master.detail-category',$data);
    }

    /**
     * Store or update the data (based on wheter or not id category exist)
     * @param Request
     * @return flash session
     */
    public function save(Request $request)
    {
        $validation = Validator::make($request->all(),Category::FORM_VALIDATION,Category::VALIDATION_MESAGE);
        if($validation->fails()) {
            return redirect()->route('masterData.category.add')->withErrors($validation)->withInput();
        }

        if($request->has('id') && !empty($request->id)) {
            $category = Category::find($request->id);
        } else {
            $category = new Category();            
        }
        $category->name           = $request->name;
        $category->description    = $request->description;
        $category->status_id      = $request->status_id;

        if($category->save()) {
            return redirect()->route('masterData.category.index')->with(['success'=>'Data berhasil disimpan!']);
        } else {
            return redirect()->route('masterData.category.index')->with(['error'=>'Data gagal disimpan!']);
        }
    }

    /**
     * Get data with datatable format
     * @param Request
     * @return JSON type data
     */
    public function getDataTable(Request $request)
    {
        $datas = Category::query();
        $datas->with('categoryStatus');

        if($request->has('status') && !empty($request->status)) {
            $datas->where('status_id',$request->status);
        }

        $datas->get();

        return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('status',function($data){
                return $data->categoryStatus->name;
            })
            ->addColumn('action', function ($data) {
                $statusBtn = '<li><a onclick="changeStatus('.$data->id.' , \' '. 1 .' \')" href="javascript:void(0);"><i class="fa fa-check"></i> Aktif</a></li>';
                if($data->status_id == 1) {
                    $statusBtn = '<li><a onclick="changeStatus('.$data->id.' , \' '. 2 .' \')" href="javascript:void(0);"><i class="fa fa-times"></i> Tidak Aktif</a></li>';
                }
                return '<div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                            <li><a href="'.route('masterData.category.detail',['id'=>$data->id,'mode'=>Constant::COMMON_MODE_DETAIL]).'"><i class="fa fa-search"></i> Detail</a></li>
                            <li><a href="'.route('masterData.category.detail',['id'=>$data->id,'mode'=>Constant::COMMON_MODE_EDIT]).'"><i class="fa fa-edit"></i> Edit</a></li>
                            '.$statusBtn.'
                            </ul>
                        </div>';
            })
            ->escapeColumns([])->make(true);
    }

    /**
     * Change status of category
     * @param Request
     * @return JSON
     */
    public function changeStatus($id, Request $request)
    {
        $category = Category::find($id);
        $category->status_id = $request->status;
        if($category->save()) {
            return response()->json(['success'=>true,'message'=>'Status berhasil diubah!']);
        } else {
            return response()->json(['success'=>false,'message'=>'Status berhasil diubah!']);
        }
    }
}
