<div class="modal fade" id="add_sem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ins_sem" class="form-horizontal" method="POST" action="{{ route('addSemester') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="en_name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name">
                            <input id="year_id" type="hidden" class="form-control" name="year_id" value="{{$year->id}}">

                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="ar_name" class="col-md-4 control-label">Start Date</label>

                        <div class="col-md-6">
                            <input id="ar_name" type="text" class="form-control"
                                   name="start_date" placeholder="y-m-d" value="{{$year->start_date}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="duration" class="col-md-4 control-label">end_date</label>

                        <div class="col-md-6">
                            <input id="end_date" type="text" class="form-control" name="end_date" placeholder="y-m-d">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-md-4 control-label">Status</label>

                        <div class="col-md-6">
                            <input id="password" type="text" class="form-control" name="status">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="en_desc" class="col-md-4 control-label">Description</label>

                        <div class="col-md-6">
                            <textarea id="en_desc" type="text" class="form-control" name="en_desc" required></textarea>
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

