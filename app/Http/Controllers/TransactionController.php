<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Services\TransactionService;
use App\Utils\Constant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class TransactionController extends Controller
{
    public function index($id)
    {
        $transaction_type = TransactionStatus::find($id);
        if(empty($transaction_type)) abort(404);

        $data['title']      = 'Dompet Masuk';
        $data['sidebar']    = 'wallet_in';
        if($transaction_type->id == 2) {
            $data['title']      = 'Dompet Keluar';
            $data['sidebar']    = 'wallet_out';
        }
        return view('pages.transaction.index',$data);
    }

    public function add($id)
    {
        $transaction_type = TransactionStatus::find($id);
        if(empty($transaction_type)) abort(404);

        $data['title']      = 'Tambah Dompet Masuk';
        $data['sidebar']    = 'wallet_in';
        if($transaction_type->id == 2) {
            $data['title']      = 'Tambah Dompet Keluar';
            $data['sidebar']    = 'wallet_out';
        }
        $data['model']   = Transaction::class;
        $data['mode']    = '';
        return view('pages.transaction.detail',$data);
    }

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
        if($request->has('transaction_id') && !empty($request->transaction_id)) {
            $transaction = Transaction::find($request->transaction_id);
        } else {
            $transaction = new Transaction();
            $transaction->transaction_date = Carbon::now();
            $transaction->status_id        = $request->transaction_type;
        }

        $transaction->amount         = $request->amount;
        $transaction->description    = $request->description;
        $transaction->wallet_id      = $request->wallet_id;
        $transaction->category_id    = $request->category_id;
        $transaction->save();

        $type = Constant::COMMON_TRANSACTION_IN;
        if($request->transaction_type == 2) {
            $type = Constant::COMMON_TRANSACTION_OUT;
        }
        $transaction->transaction_code = TransactionService::generateTransactionNumber($transaction->id,$type);

        if($transaction->save()) {
            return redirect()->route('transaction.index',['id'=>$request->transaction_type])->with(['success'=>'Data berhasil disimpan!']);
        } else {
            return redirect()->route('transaction.index',['id'=>$request->transaction_type])->with(['error'=>'Data gagal disimpan!']);
        }
    }

    /**
     * Get data with datatable format
     * @param Request
     * @return JSON type data
     */
    public function getDataTable(Request $request)
    {
        $datas = Transaction::query();
        $datas->select(['wallets.name as wallet', 'categories.name as category', 'transactions.*']);
        $datas->leftJoin('wallets','transactions.wallet_id','wallets.id');
        $datas->leftJoin('categories','transactions.category_id','categories.id');
        // $datas->with(['wallet','category','status']);

        $datas->where('transactions.status_id',$request->status_id);

        $datas->get();

        return DataTables::of($datas)
            ->addIndexColumn()
            ->editColumn('amount',function($data){
                if($data->status_id == 2) {
                    return '(-) '.GeneralHelper::moneyFormat($data->amount);    
                }
                return '(+) '.GeneralHelper::moneyFormat($data->amount);
            })
            ->escapeColumns([])->make(true);
    }
}
