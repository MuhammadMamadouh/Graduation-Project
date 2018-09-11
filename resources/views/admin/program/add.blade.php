<div class="modal fade" id="add_prog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ins_prog" class="form-horizontal" method="POST" action="{{ route('addProgram') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$department->id}}" name="department_ID">
                    <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                        <label for="en_name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="en_name" type="text" class="form-control" name="en_name"
                                   required autofocus>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                        <label for="duration" class="col-md-4 control-label">Duration</label>

                        <div class="col-md-6">
                            <input id="duration" type="text" class="form-control" name="duration" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="col-md-4 control-label">Type</label>

                        <div class="col-md-6">
                            <input id="type" type="text" class="form-control" name="type" required>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <span class="help-block">
                            <strong id="add-error" style="color: #F00"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
