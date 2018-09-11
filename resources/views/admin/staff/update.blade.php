<div class="modal fade" id="edit_staff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Staff information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="upd_staff" class="form-horizontal" method="POST" action="{{ route('editStaff') }}">
                    {{ csrf_field() }}

                    <input name="id" type="hidden" value="{{$staff->id}}">
                    <input name="department" type="hidden" value="{{$staff->dep_id}}">

                    <div class="form-group">
                        <label for="en_name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="en_name" type="text" class="form-control" name="en_name"
                                   required autofocus value="{{$staff->en_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required
                                   value="{{$staff->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-md-4 control-label">Mobile</label>

                        <div class="col-md-6">
                            <input id="mobile" type="text" class="form-control" name="mobile"
                                   value="{{$staff->mobile}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="degree" class="col-md-4 control-label">Academic Degree</label>

                        <div class="col-md-6">

                            <select name="academic_degree_id" class="form-control">
                                @foreach($ac_degrees as $degree)

                                    <option value="{{$degree->id}}">{{$degree->en_degree}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="job" class="col-md-4 control-label">Job</label>

                        <div class="col-md-6">

                            <select name="job" class="form-control">
                                @foreach($jobs as $job)
                                    <option value="{{$job->id}}">{{$job->en_title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="help-block">
                            <strong id="update-error" style="color: #F00"></strong>
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>