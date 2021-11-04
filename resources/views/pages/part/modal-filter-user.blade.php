<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
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
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="tryout_id" value="{{@$tryout->id}}">
                    <input type="hidden" name="method" value="">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <label for="">Target Jurusan</label>
                            <div class="form-group form-float">
                                <select class="form-control show-tick" name="f_jurusan">
                                <option value="">--- Semua Jurusan ---</option>
                                @foreach(\App\Utilities\Constants::JURUSAN_LISTS as $key => $jurusan)
                                <option value="{{$key}}">{{$jurusan}}</option>
                                @endforeach
                            </select>
                                <div id="tryout_name_error"></div>
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