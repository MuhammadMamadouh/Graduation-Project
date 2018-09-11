<div class="modal fade" id="edit_degree" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form id="update_degree" class="form-horizontal" method="POST" action="{{route('editDegree') }}">
                    {{ csrf_field() }}

                    <input id="id" value="" type="hidden" class="form-control" name="id">
                    <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="en_degree" type="text" class="form-control" name="en_degree"
                                   placeholder="Degree"
                                   required>
                        </div>
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