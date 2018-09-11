<div class="modal fade" id="edit_aim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="update_aim" class="form-horizontal" method="POST" action="{{route('EditFacultyAim') }}">
                    {{csrf_field()}}
                    <input type="hidden" id="id" name="id" value="">

                    <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-2 control-label">Content</label>

                        <div class="col-md-8">
                            <textarea id="content" type="text" rows="6" class="form-control" name="en_content"
                            ></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="help-block">
                            <strong id="error-block" style="color: #F00"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>