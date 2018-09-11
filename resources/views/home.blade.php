@extends('adminlte::user')
@section('css')
    <style>
        .skin-blue .main-header .navbar {
            background-color: #000000;
        }

        .skin-blue .main-header .logo {
            background-color: #333333;
            color: #fff;
            border-bottom: 0 solid transparent;
        }

        .content-wrapper {
            background-color: #ffffff;
        }

        .container {
            font-size: 18px;
        }
    </style>
@endsection


@section('title', 'Home')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{\Session::get('error')}}
        </div>
    @endif
    <p>You are logged in!</p>
<a class="btn btn-info" href="/event">make event</a>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    {!! Form::open(['url' => '/upload_file', 'files'=>true]) !!}
    {!! Form::textarea('text') !!}
    {!! Form::submit('save') !!}
    {!! Form::close() !!}
@stop