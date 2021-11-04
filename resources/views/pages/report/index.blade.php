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
                        {{--<a href="{{route('report.index')}}"> <i class="fa fa-chevron-left"></i> </a>--}}
                        {{$title}}
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <form method="POST" action="{{route('report.result')}}">
                            {{csrf_field()}}
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Tanggal Awal</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control custom-datepicker" placeholder="Tanggal Awal" name="start_date" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Tanggal Akhir</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control custom-datepicker" placeholder="Tanggal Awal" name="end_date" value="" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Status</label>
                                <div class="form-group form-float">
                                    @foreach(\App\Helpers\SelectHelper::getTransactionType() as $data)
                                    <div class="form-check">
                                        <input class="form-check-input filled-in" type="checkbox" name="status[]" id="defaultCheck{{$loop->index}}" value="{{$data->id}}">
                                        <label class="form-check-label" for="defaultCheck{{$loop->index}}">
                                            Tampilkan Uang {{$data->name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Kategori</label>
                                <div class="form-group form-float">
                                    <select class="form-control show-tick" name="category_id">
                                        <option value="">Tampilkan Semua</option>
                                        @foreach(\App\Helpers\SelectHelper::getCategories() as $data)
                                        <option @if(@$model->category_id == $data->id) selected @endif value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Dompet</label>
                                <div class="form-group form-float">
                                    <select class="form-control show-tick" name="wallet_id">
                                        <option value="">Tampilkan Semua</option>
                                        @foreach(\App\Helpers\SelectHelper::getWallets() as $data)
                                        <option @if(@$model->wallet_id == $data->id) selected @endif value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('customJS')
<script>
    $('.custom-datepicker').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        clearButton: true,
        time: false,
    });
</script>
@endpush
@endsection