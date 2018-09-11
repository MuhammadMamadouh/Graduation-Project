<div class="modal fade" id="add_gradess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add degree</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_ins_gradess" class="form-horizontal" method="POST" action="{{route('addFacultyGrade') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="faculty_id" value="{{$faculty_id}}">
                    {{--@foreach($grades as $grade)--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="title" class="col-md-4 control-label">{{$grade->en_name}}</label>--}}

                    {{--<div class="col-md-6">--}}
                    {{--<input id="percentage" type="text" class="form-control" name="{{$grade->en_name}}">--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--@endforeach--}}
                    <div class="form-group">
                        <label for="grade" class="col-md-4 control-label">Teacher</label>

                        <div class="col-md-6">
                            <select id="grade" name="grade_id" class="form-control">
                                @foreach($grades as $grade)
                                    <option value="{{$grade->id}}">{{$grade->en_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{$errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title"  type="text" name="percentage"  class="form-control" required>
                        </div>
                    </div>
                   >
                    <div class="col-md-6 pull-left">
                        <span class="help-block">
                            <strong id="help-block" style="color: #F00"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4 pull-right">
                            <button type="submit" class="btn btn-primary ">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>