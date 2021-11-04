@extends('layouts.base')
@section('title','Files')
@push('customCSS')
<style>
    .file-icon {
        font-size: 35px;
        text-align: center;
    }
    .file-icon i {
        font-size: 65px;
    }
</style>
@endpush
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
    <div class="block-header">
        <h2>Files</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    @if(\Auth::user()->role == \App\Utilities\Constants::ROLE_ADMIN)
                    <h2><a href="{{route('tryouts.index')}}"><i class="fa fa-chevron-left"></i></a> Kumpulan file Tryout {{$tryout->tryout_name}}</h2>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary waves-effect" onclick="addData()">Upload File</button>
                    </div>
                    @else
                    <h2><a href="{{route('user.tryouts.index')}}"><i class="fa fa-chevron-left"></i></a> Kumpulan file Tryout {{$tryout->tryout_name}}</h2>
                    @endif
                </div>
                <div class="body">
                    <div class="row">
                        @forelse($tryout->files as $file)
                        <div class="col-md-3">
                            <h5 class="text-center">{{$file->file_name}}</h5>
                            <div class="file-icon">
                                <i class="material-icons">insert_drive_file</i>
                            </div>
                            <div class="text-center">
                                <a href="{{ url($file->file_path) }}" target="_blank" class="btn btn-primary btn-xs waves-effect"> <i class="material-icons">download</i></a>
                                @if(\Auth::user()->role == \App\Utilities\Constants::ROLE_ADMIN)
                                <a href="javascript:;" onclick="deleteData('{{$file->id}}')" class="btn btn-danger btn-xs waves-effect"> <i class="material-icons">delete_forever</i></a>
                                @endif
                            </div>
                        </div>
                        @if(($loop->index + 1) % 4 == 0 && $loop->index != 0)
                        <div class="clearfix"></div>
                        @endif
                        @empty
                        <p>Tidak ada file</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.part.modal-file')
@push('customJS')
<script>

    function addData() {
        $('.modal-title').text('Upload Files');
        $('[name="method"]').val('add');
        $('#myModal form')[0].reset();
        $('[name="id"]').val(0);
        $('.form-line').removeClass('focused');
        $('#myModal').modal('show');
    }

    function saveData(){
        var url = "{{ route('tryouts.uploadFile') }}";

        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($("#myForm")[0]),
            processData: false,
            contentType: false,
            success: function(data){
                if(data.success){
                    swal({
                        title: 'Berhasil Simpan Data',
                        text: data.message,
                        icon: 'success',
                        timer: '3000'
                    }).then(()=>{
                        location.reload(); 
                    });
                } else {
                    swal({
                        title: 'Gagal Simpan Data',
                        text: data.message,
                        icon: 'error',
                        timer: '3000'
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                swal({
                    title: 'System Error',
                    text: errorThrown,
                    icon: 'error',
                    timer: '4000'
                });
            }
        });
    }

    function deleteData(id){
        var url = "{{ route('tryouts.deleteFile',['id'=>':id']) }}";
        url = url.replace(':id',id);

        swal({
            title: "Anda yakin?",
            text: "Dengan ini file akan dihapus",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((done)=>{
            if(done){
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        if(data.success){
                            swal('Berhasil',data.message,'success');
                            location.reload(); 
                        } else {
                            swal('Gagal',data.message,'warning');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                            title: 'System Error',
                            text: errorThrown,
                            icon: 'error',
                            timer: '3000'
                        });
                    }
                });
            }
        });
    }
</script>
@endpush
@endsection