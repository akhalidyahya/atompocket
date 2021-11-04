<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * index page of laporan
     */
    public function index()
    {
        $data['sidebar'] = 'report';
        $data['title']   = 'Laporan Transaksi';
        return view('pages.report.index',$data);
    }

    /**
     * Result page
     * @param Request
     * @return view
     */
    public function result(Request $request) {
        $data['sidebar'] = 'report';
        $data['title']   = 'Riwayat Transaksi';

        $transaction = Transaction::query();
        $transaction->with(['wallet','category','status']);

        if($request->has('start_date') && !empty($request->start_date)) {
            $transaction->where('transaction_date','>=',$request->start_date);
        }

        if($request->has('end_date') && !empty($request->end_date)) {
            $transaction->where('transaction_date','>=',$request->end_date);
        }

        if($request->has('status') && !empty($request->status)) {
            $i = 0;
            foreach($request->status as $status) {
                if($i == 0) {
                    $transaction->where('status_id',$status);
                } else {
                    $transaction->orWhere('status_id',$status);
                }
                $i++;
            }
        }

        if($request->has('category_id') && !empty($request->category_id)) {
            $transaction->where('category_id',$request->category_id);
        }

        if($request->has('wallet_id') && !empty($request->wallet_id)) {
            $transaction->where('wallet_id',$request->wallet_id);
        }

        $data['result']  = $transaction->get();
        $data['request'] = $request->all();
        return view('pages.report.result',$data);
    }
}
