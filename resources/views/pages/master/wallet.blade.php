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
                        Master Data Dompet <small>Manajemen master data dompet...</small>
                    </h2>
                </div>
                <div class="body">
                    <div class="text-right m-b-15">
                        <button type="button" class="btn btn-primary waves-effect m-r-5" onclick="openFilter()">
                            <i class="material-icons">filter_list</i>
                        </button>
                        <a href="{{route('masterData.wallet.add')}}" class="btn btn-primary waves-effect btn-icon m-r-5">
                            <i class="material-icons">add</i>
                            <span>Buat Baru</span>
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>	
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Referensi</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.master.part.modal-filter-status')
@push('customJS')
<script src="{{asset('admin/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script>
    var table = $('#dataTable').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            'url': "{{ route('masterData.wallet.getDataTable') }}",
            'data': function(d) {
                d.status = $('#f_status').val();
            }
        },
        'dataType': 'json',
        'paging': true,
        'lengthChange': true,
        'responsive': true,
        'columns': [
            {data: 'DT_RowIndex',name: 'DT_RowIndex',searchable:false,orderable:false},
            {data: 'name',name: 'name'},
            {data: 'reference',name: 'reference'},
            {data: 'description',name: 'description'},
            {data: 'status',name: 'status',searchable:false,orderable:false},
            {data: 'action',name: 'action',searchable:false,orderable:false},
        ],
        'info': true,
        'autoWidth': false
    });

    function filter() {
        table.ajax.reload();
    }

    function openFilter() {
        $('#filterModal .modal-title').text('Filter Data');
        $('#filterModal').modal('show');
    }
    
    function changeStatus(dataId,status) {
        var url = "{{ route('masterData.wallet.changeStatus',['id'=>':id']) }}";
        let dataForm = {
            status : status,
        };
        
        url = url.replace(':id',dataId);
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
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    data: dataForm,
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