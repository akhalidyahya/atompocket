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
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="file_name" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Nama File
                                    </label>
                                </div>
                                <div id="file_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Upload File</label>
                                <input type="file" name="upload_file" class="form-control" value="" required>
                                <div id="upload_file_error"></div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="saveData()">Save</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>