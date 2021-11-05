<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Utils\Constant;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class WalletController extends Controller
{
    /**
     * Index Dompet page
     */
    public function index()
    {
        $data['sidebar'] = 'wallet';
        return view('pages.master.wallet',$data);
    }

    /**
     * Add Dompet page
     */
    public function add()
    {
        $data['sidebar'] = 'wallet';
        $data['title']   = 'Tambah';
        $data['model']   = Wallet::class;
        $data['mode']    = '';
        return view('pages.master.detail-wallet',$data);
    }

    /**
     * Detail (edit,detail) Dompet page
     * @param id of the Dompet and mode (edit or detail)
     */
    public function detail($id,$mode)
    {
        $data['sidebar'] = 'wallet';
        $data['title']   = Constant::COMMON_MODE_LIST[$mode];
        $data['model']   = Wallet::find($id);
        $data['mode']    = $mode;
        if(empty($data['model']) || !in_array($mode,[Constant::COMMON_MODE_EDIT,Constant::COMMON_MODE_DETAIL])) {
            abort(404);
        }
        return view('pages.master.detail-wallet',$data);
    }

    /**
     * Store or update the data (based on wheter or not id wallet exist)
     * @param Request
     * @return flash session
     */
    public function save(Request $request)
    {
        $validation = Validator::make($request->all(),Wallet::FORM_VALIDATION,Wallet::VALIDATION_MESAGE);
        if($validation->fails()) {
            return redirect()->route('masterData.wallet.add')->withErrors($validation)->withInput();
        }

        if($request->has('id') && !empty($request->id)) {
            $wallet = Wallet::find($request->id);
        } else {
            $wallet = new Wallet();            
        }
        $wallet->name               = $request->name;
        $wallet->reference          = $request->reference;
        $wallet->description        = $request->description;
        $wallet->wallet_status_id   = $request->wallet_status_id;

        if($wallet->save()) {
            return redirect()->route('masterData.wallet.index')->with(['success'=>'Data berhasil disimpan!']);
        } else {
            return redirect()->route('masterData.wallet.index')->with(['error'=>'Data gagal disimpan!']);
        }
    }

    /**
     * Get data with datatable format
     * @param Request
     * @return JSON type data
     */
    public function getDataTable(Request $request)
    {
        $datas = Wallet::query();
        $datas->with('walletStatus');

        if($request->has('status') && !empty($request->status)) {
            $datas->where('wallet_status_id',$request->status);
        }

        $datas->get();

        return DataTables::of($datas)
            ->addIndexColumn()
            ->addColumn('status',function($data){
                return $data->walletStatus->name;
            })
            ->addColumn('action', function ($data) {
                $statusBtn = '<li><a onclick="changeStatus('.$data->id.' , \' '. 1 .' \')" href="javascript:void(0);"><i class="fa fa-check"></i> Aktif</a></li>';
                if($data->wallet_status_id == 1) {
                    $statusBtn = '<li><a onclick="changeStatus('.$data->id.' , \' '. 2 .' \')" href="javascript:void(0);"><i class="fa fa-times"></i> Tidak Aktif</a></li>';
                }
                return '<div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Manage <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                            <li><a href="'.route('masterData.wallet.detail',['id'=>$data->id,'mode'=>Constant::COMMON_MODE_DETAIL]).'"><i class="fa fa-search"></i> Detail</a></li>
                            <li><a href="'.route('masterData.wallet.detail',['id'=>$data->id,'mode'=>Constant::COMMON_MODE_EDIT]).'"><i class="fa fa-edit"></i> Edit</a></li>
                            '.$statusBtn.'
                            </ul>
                        </div>';
            })
            ->escapeColumns([])->make(true);
    }

    /**
     * Change status of wallet
     * @param Request
     * @return JSON
     */
    public function changeStatus($id, Request $request)
    {
        $wallet = Wallet::find($id);
        $wallet->wallet_status_id = $request->status;
        if($wallet->save()) {
            return response()->json(['success'=>true,'message'=>'Status berhasil diubah!']);
        } else {
            return response()->json(['success'=>false,'message'=>'Status berhasil diubah!']);
        }
    }
}
