@extends('layouts.base')
@section('title','Participants')
@push('customCSS')
<!-- datatable -->
<link href="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet" />
<!-- Font Awesome -->
<link href="{{asset('admin/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
@endpush
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
    <div class="block-header">
        <h2>Manajemen Peserta</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" onclick="addData()">Tambah</button>
                        
                        <a type="button" class="btn btn-primary" href="{{ route('participants.export') }}">Unduh Data User</a>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id='myTable' class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nomor Pendaftaran</th>
                                            <th scope="col">Nama Peserta</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Jurusan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Bukti</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.part.modal-participant')
@push('customJS')
<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('admin/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
<script>
    var table = $('#myTable').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': "{{ route('participants.dataTable') }}",
        'dataType': 'json',
        'paging': true,
        'lengthChange': true,
        'responsive': true,
        'columns': [
            {
                "data": null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'nomor_pendaftaran',name: 'nomor_pendaftaran'},
            {data: 'name',name: 'name'},
            {data: 'email',name: 'email'},
            {data: 'jurusan',name: 'jurusan'},
            {data: 'status_pembayaran',name: 'status_pembayaran'},
            {data: 'bukti_pembayaran',name: 'bukti_pembayaran'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        'info': true,
        'autoWidth': false
    });

    function filter() {
        table.draw();
    }

    function changeStatus(userId,status) {
        var url = "{{ route('participants.changeStatus',['user_id'=>':id']) }}";
        url = url.replace(':id',userId);
        swal({
            title: "Status akan dirubah?",
            text: "Dengan ini status akan diubah",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((done)=>{
            if(done){
                $.ajax({
                    url: url,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {status_pembayaran:status },
                    success: function(data){
                        if(data.success){
                            swal('Berhasil',data.message,'success');
                            table.ajax.reload();
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

    function addData(){
        $('.modal-title').text('Tambah Peserta');
        $('[name="method"]').val('add');
        $('[name="id"]').val(0);
        $('#myModal form')[0].reset();
        $('.form-line').removeClass('focused');
        $('#myModal').modal('show');
    }

    function saveData(){
        $('#myForm').validate({
            highlight: function (input) {
                console.log(input);
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.input-group').append(error);
            }
        });
        
        var url = "{{ route('participants.save') }}";

        $.ajax({
            url: url,
            type: 'POST',
            data: $('#myForm').serialize(),
            success: function(data){
                if(data.success){
                    swal({
                        title: 'Berhasil Simpan Data',
                        text: data.message,
                        icon: 'success',
                        timer: '3000'
                    }).then(()=>{
                        $('#myModal').modal('hide');
                        table.ajax.reload();
                    });
                } else {
                    swal({
                        title: 'Gagal Simpan Data',
                        text: data.message,
                        icon: 'error',
                        timer: '3000'
                    }).then(()=>{
                        $('#myModal').modal('hide');
                        table.ajax.reload();
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                swal({
                    title: 'System Error',
                    text: errorThrown,
                    icon: 'error',
                    timer: '4000'
                }).then(()=>{
                    $('#modalBank').modal('hide');
                    table.ajax.reload();
                });
            }
        });
    }

    function editData(id){
        $('.modal-title').text('Edit data peserta');
        $('.form-line').removeClass('focused');
        $('[name="method"]').val('edit');
        $('[name="id"]').val(id);
        $('#myModal form')[0].reset();
        var url = "{{route('participants.getById')}}";
        $.ajax({
            url: url,
            type: 'GET',
            data: {id:id},
            success: function(data){
                $('.form-line').addClass('focused');
                $('[name="name"]').val(data.name);
                $('[name="email"]').val(data.email);
                {{-- $('[name="password"]').val(data.password); --}}
                $('[name="ttl"]').val(data.ttl);
                $('[name="jurusan"]').val(data.jurusan);
                $('[name="jenis_kelamin"]').val(data.jenis_kelamin);
                $('#myModal').modal('show');
            }
        });
    }

    function deleteData(id){
        // var url = "{{ route('tryouts.delete',['id'=>'']) }}" + '/' + id;
        var url = "{{ route('participants.delete') }}";
        swal({
            title: "Anda yakin?",
            text: "Dengan ini data akan dihapus",
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
                    data: {id:id },
                    success: function(data){
                        if(data.success){
                            swal('Berhasil',data.message,'success');
                                table.ajax.reload();
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