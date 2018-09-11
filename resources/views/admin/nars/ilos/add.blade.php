<div class="modal fade" id="add_nars_ilos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add NARS Aims</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ins_nars_ilos" class="form-horizontal" method="POST" action="{{route('addNarsILOs') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="ar_degree" class="col-md-4 control-label">Code</label>

                        <div class="col-md-6">
                            <input id="id" type="text" class="form-control"
                                   name="id" placeholder="">

                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Content</label>

                        <div class="col-md-6">
                            <textarea id="title" type="text" rows="5" class="form-control" name="en_content"
                                      required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="genre" class="col-md-4 control-label">Genre</label>

                        <div class="col-md-6">

                            <select name="genre_id" class="form-control">
                                @foreach($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->en_title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="help-block">
                            <strong id="add-error" style="color: #F00"></strong>
                        </span>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>