@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <button class="btn btn-primary pull-right" id="view">vw</button>
                    <button class="btn btn-primary pull-right" id="read">view</button>
                    <div class="panel-heading">Add teacher of the Course</div>
                    <h1>{{$course[0]->en_title}}</h1>
                    <div class="panel-body">
                        <form action="{{route('addTeacher')}}" class="form-horizontal" method="POST">
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
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="departs" class="col-md-4 control-label">Department</label>

                                <div class="col-md-6">
                                    <select id="departs" name="department" class="form-control">

                                    </select>

                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('staff') ? ' has-error' : '' }}">
                                <label for="teacher" class="col-md-4 control-label">Teacher</label>

                                <div class="col-md-6">
                                    <select id="staff" name="teacher" class="form-control">
                                        @foreach($staffs as $staff)
                                            {{--<option value="{{$staff->id}}">{{$staff->en_name}}</option>--}}
                                        @endforeach
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
@endsection

{{--@section('js')--}}
    {{--<script type="text/javascript">--}}
        {{--$('#faculties').change(function () {--}}
            {{--$('#departs').empty();--}}
            {{--$('#staff').empty();--}}

            {{--var selected = $(this).find('option:selected').attr('value');--}}
            {{--var url = '/admin/department/view-all/f=' + selected;--}}
            {{--$.get(url, function (data) {--}}
                {{--$('#departs').empty().append(data)--}}
            {{--});--}}
            {{--$('#departs').change(function () {--}}
                {{--var selected = $(this).find('option:selected').attr('value');--}}
                {{--var url = '/admin/staff/view-all/d=' + selected;--}}
                {{--$.get(url, function (data) {--}}
                    {{--$('#staff').empty().append(data)--}}

                {{--})--}}
            {{--});--}}
            {{--$('#staff').change(function () {--}}
                {{--var selected = $(this).find('option:selected').attr('value');--}}
                    {{--console.log(selected)--}}

            {{--});--}}
        {{--})--}}



        // $.each(data, function (i, value) {
        //     var tr = $('<tr/>');
        //     tr.append($("<td/>", {
        //         text : value.id
        //     })).append($("<td/>", {
        //         text : value.en_name
        //     })).append($("<td/>", {
        //         text : value.ar_name
        //     })).append($("<td/>", {
        //         html :  "<a href='#'>view</a> <a href='#'>edit</a> <a href='#'>delete</a> "
        //     }))
        //     $('#departs').append(tr);
        // })
        // })
        // })
    </script>

@endsection