@extends('layouts.base')
@section('title','Master Data Dompet')
@push('customCSS')
<link href="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet" />
@endpush
@section('content')
<div class="container-fluid">
    <!-- <div class="block-header">
        <h2>Master Data Dompet</h2>
    </div> -->
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <a href="{{route('masterData.wallet.index')}}"> <i class="fa fa-chevron-left"></i> </a>
                        {{$title}} Data Dompet <small>Manajemen master data dompet...</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <form id="walletForm" method="POST" action="{{route('masterData.wallet.save')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{@$model->id}}">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Contoh: Dompet Utama" name="name" value="{{ !empty(old('name')) ? old('name') : @$model->name }}" required />
                                    </div>
                                    @error('name')
                                    <div class="col-red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Referensi</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Contoh: 921381237820" name="reference" value="{{ !empty(old('reference')) ? old('reference') : @$model->reference}}"/>
                                    </div>
                                    @error('reference')
                                    <div class="col-red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <div class="form-line">
                                        <textarea type="text" class="form-control" placeholder="Contoh: Bank Mandiri" name="description" >{{ !empty(old('description')) ? old('description') : @$model->description}}</textarea>
                                    </div>
                                    @error('description')
                                    <div class="col-red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Status Dompet</label>
                                <div class="form-group form-float">
                                    <select class="form-control show-tick" name="wallet_status_id">
                                        @foreach(\App\Helpers\SelectHelper::getWalletStatus() as $data)
                                        <option @if(@$model->wallet_status_id == $data->id || @old('wallet_status_id') == $data->id) selected @endif value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($mode == \App\Utils\Constant::COMMON_MODE_EDIT || @$mode == '')
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
$('#walletForm').validate({
    rules: {
        name: {
            required: true,
            minlength: 5
        },
        description: {
            maxlength: 100
        }
    }
});
</script>
@endpush
@endsection