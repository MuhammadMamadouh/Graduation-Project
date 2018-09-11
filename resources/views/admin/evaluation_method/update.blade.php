<div class="modal fade" id="edit_evaluation_method" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form id="update_evaluation_method" class="form-horizontal" method="POST"
                      action="{{route('editEvalMethod') }}">
                    {{ csrf_field() }}

                    <input id="id" value="" type="hidden" class="form-control" name="id">
                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="en_evaluation_method" type="text" class="form-control" name="en_method" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="help-block">
                            <strong id="update-error" style="color: #F00"></strong>
                        </span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>