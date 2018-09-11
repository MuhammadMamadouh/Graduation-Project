<div class="modal fade" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <form action="{{route('addDepartAdmin')}}" class="form-horizontal" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" name="department" value="{{$department->id}}">

                        <div class="form-group">
                            <label for="teacher" class="col-md-4 control-label">Teacher</label>

                            <div class="col-md-6">
                                <select id="staff" name="admin" class="form-control">
                                    @foreach($all_staffs as $staff)
                                    <option value="{{$staff->id}}">{{$staff->en_name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
</div>
