<div class="modal fade" id="add_course" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                <form id="ins_course" class="form-horizontal" method="POST" action="{{ route('addCourse') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="semester_id" value="{{$semester->id}}">

                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">code</label>

                        <div class="col-md-6">
                            <input id="code" type="text" class="form-control" name="code" placeholder="Code of course"
                                   required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="en_title"
                                   placeholder="Title of course" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="weakly_hours" class="col-md-4 control-label">weakly_hours</label>

                        <div class="col-md-6">
                            <input id="weakly_hours" type="text" class="form-control" name="weakly_hour"
                                   placeholder="weakly_hours" required autofocus>

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('weakly_hours') ? ' has-error' : '' }}">
                        <label for="weakly_hours" class="col-md-4 control-label">Students</label>

                        <div class="col-md-6">
                            <input id="students" type="text" class="form-control" name="students"
                                   placeholder="students" required autofocus>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <span class="add-error">
                            <strong id="add-error" style="color: #F00"></strong>
                        </span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

