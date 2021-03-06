@extends('layouts.base')
@section('title','Master Data Kategori')
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
                        <a href="{{route('masterData.category.index')}}"> <i class="fa fa-chevron-left"></i> </a>
                        {{$title}} Data kategori <small>Manajemen master data kategori...</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <form id="categoryForm" method="POST" action="{{route('masterData.category.save')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{@$model->id}}">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Nama" name="name" value="{{!empty(old('name')) ? old('name') : @$model->name}}" />
                                    </div>
                                    @error('name')
                                    <div class="col-red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <div class="form-line">
                                        <textarea type="text" class="form-control" placeholder="Deskripsi" name="description" >{{ !empty(old('description')) ? old('description') :  @$model->description}}</textarea>
                                    </div>
                                    @error('description')
                                    <div class="col-red">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Status Dompet</label>
                                <div class="form-group form-float">
                                    <select class="form-control show-tick" name="status_id" value="{{old('status_id')}}">
                                        @foreach(\App\Helpers\SelectHelper::getCategoryStatus() as $data)
                                        <option @if(@$model->wallet_status_id == $data->id || @old('status_id') == $data->id) selected @endif value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
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
$('#categoryForm').validate({
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