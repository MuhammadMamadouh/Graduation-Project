<div class="modal fade" id="add_program_aims" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Program Aims</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ins_program_aims" class="form-horizontal" method="POST" action="{{route('addProgramAims') }}">
                    {{ csrf_field() }}

                    <input type="hidden" value="{{$program_id}}" name="program_id">


                    <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Content</label>

                        <div class="col-md-6">
                            <textarea id="title" type="text" class="form-control" name="en_content"
                                      required></textarea>

                            @if ($errors->has('en_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('en_name') }}</strong>
                                    </span>
                            @endif
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