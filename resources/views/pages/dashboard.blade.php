@extends('layouts.base')
@section('title','Dasbor')
@push('customCSS')
<style>
    #copy {
        cursor: pointer;
    }

    #bank1 {
        font-size: 1.3em;
        border: none !important;
        outline: none !important;
        background-color: transparent !important;
        font-weight: bolder;
    }

    input[type=file] {
        background-color: #dedede !important;
        padding: 5px !important;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>Dasbor</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Selamat Datang {{\Auth::user()->name}}!</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(\Auth::user()->role == \App\Utilities\Constants::ROLE_USER && \Auth::user()->status_pembayaran != \App\Utilities\Constants::REGISTRATION_STATUS_PAID)
                            <div class="col-md-12 text-center">
                                <h4>Selesaikan Pembayaran Segera</h4>
                                <p>Status Pembayaran: <span id="statusText">{{\App\Utilities\Constants::REGISTRATION_STATUS_LISTS[\Auth::user()->status_pembayaran]}}</span></p>
                            </div>
                            <div class="col-md-4 text-center">
                                <h4 for="">Transfer Bank Mandiri</h4>
                                <div class="m-t-10">
                                    Nomor Rekening <br>
                                    <div id="bank1">9000043598334</div>
                                    A.n. Yusuf Fatahillah
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <h4 for="">Transfer Bank BRI</h4>
                                <div class="m-t-10">
                                    Nomor Rekening <br>
                                    <div id="bank1">014001060292504</div>
                                    A.n. Irfan Adhi Candra
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <h4 for="">Transfer Bank BTPN</h4>
                                <div class="m-t-10">
                                    Nomor Rekening <br>
                                    <div id="bank1">90150098227</div>
                                    A.n. Yusuf Fatahillah
                                </div>
                            </div>
                            <div class="col-md-12 m-t-10 text-center">
                                    Total Pembayaran <br>
                                    <b>Rp 25000</b>
                                </div>
                            <hr>
                            <div class="col-md-12 text-center m-t-30">
                                @if(\Auth::user()->status_pembayaran == \App\Utilities\Constants::REGISTRATION_STATUS_UNPAID || \Auth::user()->status_pembayaran == \App\Utilities\Constants::REGISTRATION_STATUS_REJECT)
                                <div class="row">
                                    <form id="myForm" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="col-md-4 text-center col-md-push-4">
                                            <div class="form-group form-float">
                                                <label class="form-label">Upload Bukti Bayar</label>
                                                <input type="file" name="bukti_pembayaran" class="form-control" value="">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('customJS')
<script>
    @if(\Auth::user()->role == \App\Utilities\Constants::ROLE_USER && \Auth::user()->status_pembayaran != \App\Utilities\Constants::REGISTRATION_STATUS_PAID)
    $('#copy').click(function() {
        let text = document.getElementById('bank1');
        text.select();
        text.setSelectionRange(0, 99999);

        document.execCommand("copy");
        swal('Nomor rekening tersalin!');
    });
    $('input[name="bukti_pembayaran"]').change(function(){
        var url = "{{ route('pembayaran.bukti') }}";

        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData($("#myForm")[0]),
            processData: false,
            contentType: false,
            beforeSend: function(e) {
                showNotification('alert-info', 'Sedang mengupload gambar...', 'top', 'right', null, null);
            },
            success: function(data){
                if(data.success){
                    swal({
                        title: 'Berhasil upload gambar',
                        text: data.message,
                        icon: 'success',
                        timer: '4000'
                    }).then(()=>{
                        $('#statusText').text("{{\App\Utilities\Constants::REGISTRATION_STATUS_LISTS[\App\Utilities\Constants::REGISTRATION_STATUS_ON_CONFIRMATION]}}");
                        $('input[name="bukti_pembayaran"]').val('');
                        $('input[name="bukti_pembayaran"]').prop('disabled',true);
                    });
                } else {
                    swal({
                        title: 'Gagal upload gambar',
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
    });
    @endif
</script>
@endpush
@endsection