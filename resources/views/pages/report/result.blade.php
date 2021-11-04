@extends('layouts.base')
@section('title',$title)
@push('customCSS')

@endpush
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <a href="{{route('report.index')}}"> <i class="fa fa-chevron-left"></i> </a>
                        {{$title}}
                        <small>{{@$request['start_date']}} - {{@$request['end_date']}}</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Kode</th>
                                            <th>Deskripsi</th>
                                            <th>Dompet</th>
                                            <th>kategori</th>
                                            <th>Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $income_amount = 0;
                                            $outcome_amount = 0;
                                        @endphp
                                        @forelse($result as $data)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$data->transaction_date}}</td>
                                            <td>{{$data->transaction_code}}</td>
                                            <td>{{$data->description}}</td>
                                            <td>{{$data->wallet->name}}</td>
                                            <td>{{$data->category->name}}</td>
                                            <td>
                                                {{
                                                    ($data->status_id == 1 ? '(+)' : '(-)') .' '. \App\Helpers\GeneralHelper::moneyFormat($data->amount)
                                                }}
                                            </td>
                                            @php
                                                if($data->status_id == 1) {
                                                    $income_amount+=$data->amount;
                                                } else {
                                                    $outcome_amount+=$data->amount;
                                                }
                                            @endphp
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">Summary</label>
                            <table>
                                <tr>
                                    <td>Total Uang Masuk</td> <td class="p-r-5 p-l-5">:</td> <td>{{\App\Helpers\GeneralHelper::moneyFormat($income_amount)}}</td>
                                </tr>
                                <tr>
                                    <td>Total Uang Keluar</td> <td class="p-r-5 p-l-5">:</td> <td>{{\App\Helpers\GeneralHelper::moneyFormat($outcome_amount)}}</td>
                                </tr>
                                <tr>
                                    <td>Total</td> <td class="p-r-5 p-l-5">:</td> <td>{{\App\Helpers\GeneralHelper::moneyFormat($income_amount - $outcome_amount)}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('customJS')
<script>

</script>
@endpush
@endsection