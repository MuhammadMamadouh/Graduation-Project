<div class="modal fade" id="edit_nars_ilos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update NARS Aims</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="upd_nars_ilos" class="form-horizontal" method="POST" action="{{route('updateNarsILOs') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="ar_degree" class="col-md-4 control-label">Code</label>
                        <div class="col-md-6">
                            <input id="id" type="text" class="form-control" name="id" placeholder="">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="en_content" class="col-md-4 control-label">Content</label>

                        <div class="col-md-6">
                            <textarea id="en_content" type="text" rows="5" class="form-control" name="en_content"
                                      required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="genre" class="col-md-4 control-label">Genre</label>

                        <div class="col-md-6">

                            <select id="genre_id" name="genre_id" class="form-control">
                                @foreach($genres as $genre)
                                    <option id="{{$genre->id}}" value="{{$genre->id}}">{{$genre->en_title}}</option>
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
                        <button type="submit" class="btn btn-primary">update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>