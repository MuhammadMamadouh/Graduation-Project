@extends('adminlte::user')
@section('css')

@endsection

@section('content')
@section('title', 'Profile')
@if(Session::has('error'))
    <div class="alert alert-danger">
        {{\Session::get('error')}}
    </div>
@endif
<div class="row">
    <div class="col-lg-7">
        <div class="basic_info">
            <h1 style="font-size: 50px">Welcome Dr. {{ Auth::user()->en_name }} </h1>
        </div>
    </div>
</div>
<!--course-->
@if(auth()->user()->admin == 1)
    <div class=”panel-body”>
        <a href='{{url("/")}}/admin/dashboard'>Go To Admin Panel ?</a>
    </div>
@elseif(isset($department))
    <div class=”panel-body”>
        Hey You Are
        <a href="{{url("/")}}admin/faculty/{{$department->faculty_id}}/department/{{$department->id}}">{{$department->en_name}}</a>
        Department Admin
    </div>
@else
    <div class="panel-heading"></div>
@endif
{{--{{$department}}--}}
<h1>My Courses: </h1>
@if(count($courses)> 0)
    <div class="list-group col-lg-6">

        @foreach($courses as $course)
            <button type="button" class="list-group-item list-group-item-success">
                {{$course->en_title}}
                <a href="{{url("/")}}/mycourse/{{$course->code}}">
                    <div class="btn btn-primary pull-right">View</div>
                </a>
            </button>
        @endforeach
    </div>
@else
    <br>
    <div class="alert alert-danger col-md-5">You Are Not Teaching Any Courses Now!</div>
    @endif
    </div>


    @endsection