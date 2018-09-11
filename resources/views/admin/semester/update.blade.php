<div class="modal fade" id="edit_sem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add YEAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="update-sem" method="POST" action="{{ route('editSemester') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="hidden" name="id" value="{{$semester->id}}">
                        <label for="en_name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" value="{{$semester->name}}" class="form-control" name="name">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="ar_name" class="col-md-4 control-label">Start Date</label>

                        <div class="col-md-6">
                            <input id="ar_name" type="text" class="form-control"
                                   name="start_date" placeholder="y-m-d" value="{{$semester->start_date}}">

                            @if ($errors->has('ar_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('ar_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label for="duration" class="col-md-4 control-label">end_date</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" value="{{$semester->end_date}}"
                                   name="end_date" placeholder="y-m-d">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="col-md-4 control-label">Status</label>

                        <div class="col-md-6">
                            <input id="status" type="text" class="form-control" name="status"
                                   value="{{$semester->status}}">
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="col-md-4 control-label">Description</label>

                        <div class="col-md-6">
                            <input id="en_desc" type="text" class="form-control" value="{{$semester->en_desc}}"
                                   name="en_desc">
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

