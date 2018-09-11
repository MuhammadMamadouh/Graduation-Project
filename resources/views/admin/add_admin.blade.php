<div class="modal fade" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <form action="{{route('addAdmin')}}" class="form-horizontal" method="POST">
                        {{ csrf_field() }}

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

                                @if ($errors->has('teacher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('faculty') }}</strong>
                                    </span>
                                @endif
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
                                <select id="staff" name="admin" class="form-control">
                                    {{--@foreach($staffs as $staff)--}}
                                    {{--<option value="{{$staff->id}}">{{$staff->en_name}}</option>--}}
                                    {{--@endforeach--}}
                                </select>

                                @if ($errors->has('teacher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('teacher') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
