@extends('layouts.base')
@section('title','Questions')
@push('customCSS')
<!-- datatable -->
<link href="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet" />

@endpush
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
    <div class="block-header">
        <h2>Soal Tryout</h2>
    </div>
    <!-- Example Tab -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <a href="{{route('tryouts.index')}}"><i class="fa fa-chevron-left"></i></a> {{$tryout->tryout_name}}
                        <!-- <small>Add quick, dynamic tab functionality to transition through panes of local content</small> -->
                    </h2>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary" onclick="addData()">Tambah Soal</button>
                    </div>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tab-nav-right" role="tablist">
                        <li role="presentation" class="active"><a href="#tpa" data-toggle="tab">TPA</a></li>
                        <li role="presentation"><a href="#tbi" data-toggle="tab">TBI</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="tpa">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='myTable-tpa' class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Jenis</th>
                                                    <th scope="col">Pertanyaan</th>
                                                    <th scope="col">Gambar</th>
                                                    <th scope="col">Jawaban Benar</th>
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
                        <div role="tabpanel" class="tab-pane fade" id="tbi">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id='myTable-tbi' class="table table-bordered table-striped table-hover dataTable js-exportable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Jenis</th>
                                                    <th scope="col">Pertanyaan</th>
                                                    <th scope="col">Gambar</th>
                                                    <th scope="col">Jawaban Benar</th>
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
    </div>
    <!-- #END# Example Tab -->
</div>
@include('pages.part.modal-question')
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

<!-- Ckeditor -->
<script src="{{asset('admin/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 200;
</script>
<script>
    var table_tpa = $('#myTable-tpa').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: "{{ route('questions.dataTable',['type'=>\App\Utilities\Constants::QUESTION_TYPE_TPA]) }}",
            data: function (d) {
                d.tryout_id = "{{ $tryout->id }}";
            }
        },
        'dataType': 'json',
        'paging': true,
        'lengthChange': true,
        'responsive': true,
        'columns': [
            {data: 'question_number',name: 'question_number'},
            {data: 'question_type',name: 'question_type'},
            {data: 'question_text',name: 'question_text'},
            {data: 'question_image',name: 'question_image'},
            {data: 'right_answer',name: 'right_answer'},
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

    var table_tbi = $('#myTable-tbi').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: "{{ route('questions.dataTable',['type'=>\App\Utilities\Constants::QUESTION_TYPE_TBI]) }}",
            data: function (d) {
                d.tryout_id = "{{ $tryout->id }}";
            }
        },
        'dataType': 'json',
        'paging': true,
        'lengthChange': true,
        'responsive': true,
        'columns': [
            {data: 'question_number',name: 'question_number'},
            {data: 'question_type',name: 'question_type'},
            {data: 'question_text',name: 'question_text'},
            {data: 'question_image',name: 'question_image'},
            {data: 'right_answer',name: 'right_answer'},
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
        table_tpa.draw();
        table_tbi.draw();
    }

    function addData(){
        $('.modal-title').text('Tambah Soal');
        $('[name="method"]').val('add');
        $('#myModal form')[0].reset();
        $('[name="id"]').val(0);
        $('.form-line').removeClass('focused');
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
        $('#myModal').modal('show');
    }

    function saveData(){
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

        var url = "{{ route('questions.save') }}";

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
                        $('#myModal').modal('hide');
                        table_tbi.ajax.reload();
                        table_tpa.ajax.reload();
                    });
                } else {
                    swal({
                        title: 'Gagal Simpan Data',
                        text: data.message,
                        icon: 'error',
                        timer: '3000'
                    }).then(()=>{
                        // $('#myModal').modal('hide');
                        // table_tbi.ajax.reload();
                        // table_tpa.ajax.reload();
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
                    // $('#myModal').modal('hide');
                    // table_tbi.ajax.reload();
                    // table_tpa.ajax.reload();
                });
            }
        });
    }

    function editData(id){
        $('.modal-title').text('Edit Soal');
        $('.form-line').removeClass('focused');
        $('[name="method"]').val('edit');
        $('[name="id"]').val(id);
        $('#myModal form')[0].reset();
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
        
        var url = "{{route('questions.getById')}}";
        $.ajax({
            url: url,
            type: 'GET',
            data: {id:id},
            success: function(data){
                $('.form-line').addClass('focused');
                $('[name="question_number"]').val(data.question_number);
                $('[name="question_type"]').val(data.question_type);
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].setData(data.question_text);
                }
                $('[name="answer_a"]').val(data.answer_a);
                $('[name="answer_b"]').val(data.answer_b);
                $('[name="answer_c"]').val(data.answer_c);
                $('[name="answer_d"]').val(data.answer_d);
                $('[name="answer_e"]').val(data.answer_e);
                $('[name="right_answer"]').val(data.right_answer).change();
                $('#myModal').modal('show');
            }
        });
    }

    function deleteData(id){
        var url = "{{ route('questions.delete') }}";
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
                                table_tbi.ajax.reload();
                                table_tpa.ajax.reload();
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