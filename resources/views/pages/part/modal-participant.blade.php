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
                    <input type="hidden" name="method" value="">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="name" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Nama Peserta
                                    </label>
                                </div>
                                <div id="tryout_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="email" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Email Peserta
                                    </label>
                                </div>
                                <div id="tryout_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" name="password" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Password
                                    </label>
                                </div>
                                <div id="tryout_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="ttl" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Tempat, Tanggal lahir
                                    </label>
                                </div>
                                <div id="tryout_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <select class="form-control show-tick" name="jurusan">
                                <option value="">--- Pilih Jurusan ---</option>
                                @foreach(\App\Utilities\Constants::JURUSAN_LISTS as $key => $jurusan)
                                <option value="{{$key}}">{{$jurusan}}</option>
                                @endforeach
                            </select>
                                <div id="tryout_name_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <select class="form-control show-tick" name="jenis_kelamin">
                                    <option value="">--- Pilih Jenis Kelamin ---</option>
                                    <option value="MALE">Laki Laki</option>
                                    <option value="FEMALE">Perempuan</option>
                                </select>
                                <div id="tryout_name_error"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
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