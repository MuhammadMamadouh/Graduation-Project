<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Faculty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frm-insert" method="POST" action="{{ route('addFaculty') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                        <label for="en_name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="en_name"
                                   placeholder="Name" required autofocus>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                        <label for="fax" class="col-md-4 control-label">Fax</label>

                        <div class="col-md-6">
                            <input id="fax" type="text" class="form-control" name="fax" placeholder="fax"
                                   autofocus>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                        <label for="telephone" class="col-md-4 control-label">Telephone</label>
                        <div class="col-md-6">
                            <input id="telephone" type="text" class="form-control" name="telephone"
                                   placeholder="telephone">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="help-block">
                            <strong id="add-error" style="color: #F00"></strong>
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
</div>