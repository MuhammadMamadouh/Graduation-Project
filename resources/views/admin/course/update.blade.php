<div class="modal fade" id="edit_course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="update_course" class="form-horizontal" method="POST" action="{{ route('editCourse') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">code</label>

                        <div class="col-md-6">
                            <input id="code" type="text" class="form-control" name="code"  value="{{$course->code}}"
                                   required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="en_title"
                                   value="{{$course->en_title}}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weakly_hours" class="col-md-4 control-label">Weakly hours</label>

                        <div class="col-md-6">
                            <input id="weakly_hours" type="text" class="form-control" name="weakly_hour"
                                   value="{{$course->weakly_hour}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="students" class="col-md-4 control-label">Students</label>

                        <div class="col-md-6">
                            <input id="students" type="text" class="form-control" name="students"
                                   value="{{$course->students}}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <span class="add-error">
                            <strong id="update-error" style="color: #F00"></strong>
                        </span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

