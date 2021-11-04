<div id="filterModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="method" value="">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <label for="">Status Dompet</label>
                            <div class="form-group form-float">
                                <select class="form-control show-tick grey-mode" id="f_status">
                                    <option value="">--- Semua Status ---</option>
                                    @foreach(\App\Helpers\SelectHelper::getWalletStatus() as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="filter()">Filter</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>