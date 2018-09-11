@extends('adminlte::page')
@section('title', 'Faculty NARS')
@section('content')
    @include('admin.faculty.aims.add')
    @include('admin.faculty.aims.edit')
    <div class="container">

        <h2 class="text-center text-dark">Aims Of Faculty</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">code</th>
                <th scope="col">Content</th>
            </tr>
            </thead>
            @foreach($aims as $content)
                <tbody id="aims">

                <tr id="{{$content->id}}">
                    <td>{{$content->code}}</td>
                    <td>{{$content->description}}</td>
                    <td>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>

        <br>
    </div>
@endsection