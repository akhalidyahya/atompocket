@extends('layouts.base')
@section('title',$title)
@push('customCSS')
<link href="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <a href="{{route('transaction.index',['id'=>\Request::route('id')])}}"> <i class="fa fa-chevron-left"></i> </a>
                        {{$title}}
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <form method="POST" action="{{route('transaction.save',['id'=>\Request::route('id')])}}">
                            {{csrf_field()}}
                            <input type="hidden" name="transaction_id" value="{{@$model->id}}">
                            <input type="hidden" name="transaction_type" value="{{\Request::route('id')}}">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Kode</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control grey-mode" placeholder="Kode akan terbuat setelah disubmit" name="transaction_code" value="{{@$model->transaction_code}}" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Tanggal</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control grey-mode" placeholder="Tanggal" name="transaction_date" value="{{!empty(@$model->transaction_date) ? @$model->transaction_date : \Carbon\Carbon::now()->format('Y-m-d')}}" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Kategori</label>
                                <div class="form-group form-float">
                                    <select class="form-control show-tick" name="category_id">
                                        @foreach(\App\Helpers\SelectHelper::getCategories() as $data)
                                        <option @if(@$model->category_id == $data->id) selected @endif value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Dompet</label>
                                <div class="form-group form-float">
                                    <select class="form-control show-tick" name="wallet_id">
                                        @foreach(\App\Helpers\SelectHelper::getWallets() as $data)
                                        <option @if(@$model->wallet_id == $data->id) selected @endif value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nilai</label>
                                    <div class="form-line">
                                        <input type="number" min="0" class="form-control" placeholder="Nilai" name="amount" value="{{@$model->amount}}" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <div class="form-line">
                                        <textarea type="text" class="form-control" placeholder="Deskripsi" name="description" >{{@$model->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @if(@$mode == \App\Utils\Constant::COMMON_MODE_EDIT || @$mode == '')
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </div>
                            @endif
                        </form>
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