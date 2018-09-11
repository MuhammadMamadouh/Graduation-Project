{{--@extends('layouts.app')--}}
{{--@section('title', 'Dashboard')--}}
{{--@section('content')--}}

    {{--<div class="container">--}}

        {{--<h2 class="text-center text-dark">Department Information</h2>--}}

        {{--<a href="{{url('admin/department/add')}}" class="btn btn-primary">Add New department</a>--}}
        {{--<table class="table table-striped table-hover">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th scope="col">id</th>--}}
                {{--<th scope="col">English Name</th>--}}
                {{--<th scope="col">Arabic Name</th>--}}

            {{--</tr>--}}
            {{--</thead>--}}

            @foreach($departments as $department)

                <tbody>
                <tr>
                    <th scope="row">{{$department->id}}</th>
                    <td>{{$department->ar_name}}</td>
                    <td>{{$department->ar_name}}</td>
                    <td><button class="btn btn-primary">view</button> </td>


                </tr>

                </tbody>
            @endforeach
        {{--</table>--}}
    {{--</div>--}}
{{--@endsection--}}