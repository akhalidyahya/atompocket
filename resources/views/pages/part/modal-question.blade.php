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
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" min="1" name="question_number" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        No Soal
                                    </label>
                                </div>
                                <div id="question_number_error"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="col-sm-12">
                                    <select class="form-control show-tick" name="question_type">
                                        <option value="">--- Pilih Jenis Soal ---</option>
                                        <option value="{{\App\Utilities\Constants::QUESTION_TYPE_TPA}}">{{\App\Utilities\Constants::QUESTION_TYPE_TPA}}</option>
                                        <option value="{{\App\Utilities\Constants::QUESTION_TYPE_TBI}}">{{\App\Utilities\Constants::QUESTION_TYPE_TBI}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form">
                                    <label class="form-label">
                                        Pertanyaan
                                    </label>
                                    <textarea name="question_text" class="form-control" id="ckeditor">
                                    </textarea>
                                </div>
                                <div id="answer_a_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <label class="form-label">Upload Gambar Pertanyaan</label>
                                <input type="file" name="question_image" class="form-control" value="" required>
                                <div id="question_image_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="answer_a" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Jawaban A
                                    </label>
                                </div>
                                <div id="answer_a_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="answer_b" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Jawaban B
                                    </label>
                                </div>
                                <div id="answer_b_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="answer_c" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Jawaban C
                                    </label>
                                </div>
                                <div id="answer_c_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="answer_d" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Jawaban d
                                    </label>
                                </div>
                                <div id="answer_d_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" name="answer_e" class="form-control" autocomplete="off" required>
                                    <label class="form-label">
                                        Jawaban E
                                    </label>
                                </div>
                                <div id="answer_e_error"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="input-group">
                                <label class="form-label">
                                    Jawaban Benar
                                </label>
                                <div class="col-sm-12">
                                    <select class="form-control show-tick" name="right_answer">
                                        <option value="">--- Pilih Jawaban Benar ---</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
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