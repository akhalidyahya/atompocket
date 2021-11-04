@extends('layouts.base')
@section('title','Ranking')
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
        <h2>Ranking</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2><a href="{{route('tryouts.index')}}"><i class="fa fa-chevron-left"></i></a> {{$tryout->tryout_name}}</h2>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary waves-effect" onclick="filterModal()">
                            <i class="material-icons">filter_list</i>
                        </button>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id='myTable' class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ranking</th>
                                            <th scope="col">No Pendaftaran</th>
                                            <th scope="col">Nama Peserta</th>
                                            <th scope="col">Target Jurusan</th>
                                            <th scope="col">Nilai TPA</th>
                                            <th scope="col">Nilai TBI</th>
                                            <th scope="col">Nilai Total</th>
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
@include('pages.part.modal-filter-rank')
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
        'ajax': {
            url : "{{ route('tryouts.rankDataTable',['tryout_id'=>$tryout->id]) }}",
            data: function(d) {
                d.jurusan = $('[name="f_jurusan"]').val();
            }
        },
        'dataType': 'json',
        'paging': true,
        'lengthChange': true,
        'responsive': true,
        "order": [[ 6, "desc" ]],
        'columns': [
            {
                "data": null,
                "sortable": false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'registration_number',name: 'registration_number',"sortable": false,},
            {data: 'name',name: 'name',"sortable": false,},
            {data: 'jurusan',name: 'jurusan',"sortable": false,},
            {data: 'tpa_score',name: 'tpa_score'},
            {data: 'tbi_score',name: 'tbi_score'},
            {data: 'total_score',name: 'total_score'},
        ],
        'info': true,
        'autoWidth': false
    });

    function filter() {
        table.draw();
    }

    function filterModal(){
        $('.modal-title').text('Filter Data');
        $('#myModal').modal('show');
    }

</script>
@endpush
@endsection