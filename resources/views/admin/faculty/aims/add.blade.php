<div class="modal fade" id="add_aim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add degree</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_ins_aim" class="form-horizontal" method="POST" action="{{route('addFacultyAim') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="faculty_id" value="{{$faculty_id}}">

                    <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-2 control-label">Content</label>

                        <div class="col-md-8">
                            <textarea id="title" type="text" rows="5" class="form-control" name="en_content"
                                      placeholder="Content"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 pull-left">
                        <span class="help-block">
                            <strong id="help-block" style="color: #F00"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4 pull-right">
                            <button type="submit" class="btn btn-primary ">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>