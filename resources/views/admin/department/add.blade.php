<div class="modal fade" id="add_depart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form id="ins_depart" class="form-horizontal" method="POST" action="{{ route('addDepartment') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="faculty_id" value="{{$faculty->id}}" class="form-control">

                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="en_name" placeholder="Name"
                                   required autofocus>
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