<div class="modal fade" id="edit_year" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit YEAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="update-year" method="POST" action="{{ route('editYear') }}">
                    {{ csrf_field() }}
                    <input id="year_id" type="hidden" value="{{$year->id}}" class="form-control"
                           name="id">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{$year->name}}">
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                        <label for="start_date" class="col-md-4 control-label">Start Date</label>

                        <div class="col-md-6">
                            <input id="start_date" type="text" class="form-control" name="start_date"
                                   value="{{$year->start_date}}" placeholder="y-m-d">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label for="end_date" class="col-md-4 control-label">End date</label>

                        <div class="col-md-6">
                            <input id="end_date" type="text" class="form-control" value="{{$year->end_date}}"
                                   name="end_date" placeholder="y-m-d">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="status" class="col-md-4 control-label">Status</label>

                        <div class="col-md-6">
                            <input id="status" type="text" class="form-control" name="status" value="{{$year->status}}">

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="en_desc" class="col-md-4 control-label">Description</label>

                        <div class="col-md-6">
                <textarea id="en_desc" type="text" class="form-control" name="en_desc" value="{{rtrim($year->en_desc, ' ')}}">
                    {{$year->en_desc}}
                </textarea>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <span class="update-error">
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
