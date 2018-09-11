<div class="modal fade" id="add_teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addTeacher" action="{{route('addTeacher')}}" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$course->code}}" name="course_code">

                    <div class="form-group{{ $errors->has('faculty') ? ' has-error' : '' }}">
                        <label for="faculty" class="col-md-4 control-label">Faculty</label>

                        <div class="col-md-6">
                            <select id="faculties" name="faculty" class="form-control">
                                <option id="" value="">Choose Faculty</option>
                                @foreach($faculties as $faculty)
                                    <option id="{{$faculty->id}}" value="{{$faculty->id}}">
                                        <a href="departments/f={{$faculty->id}}">
                                            {{$faculty->en_name}} </a></option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                        <label for="departs" class="col-md-4 control-label">Department</label>

                        <div class="col-md-6">
                            <select id="departs" name="department" class="form-control">

                            </select>

                            @if ($errors->has('teacher'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('staff') ? ' has-error' : '' }}">
                        <label for="teacher" class="col-md-4 control-label">Teacher</label>

                        <div class="col-md-6">
                            <select id="staff" name="staff_id" class="form-control">
                                {{--@foreach($staffs as $staff)--}}
                                    {{--<option value="{{$staff->id}}">{{$staff->en_name}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="add-error">
                            <strong id="addTeacher-error" style="color: #F00"></strong>
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
