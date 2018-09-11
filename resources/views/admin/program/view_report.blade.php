@extends('adminlte::page')
@section('title', "$program->en_name Report")
@section('css')
    <style>
        .table {
            font-size: 15px;
        }

    </style>
@endsection
@section('sidebar')
    <li class="header">Admins</li>
    <li class="header">Print Report</li>
    <li class="">
        <a href="#" onclick="javascript: window.print()">
            <i class="fa fa-fw fa-weibo"></i>
            <span>print report</span>
            <span class="pull-right-container">
    <span class="label label-success pull-right"></span>
    </span>
        </a>
    </li>

@endsection

@section('content')

    <div class="container">
        <div class="">
            <h3 class=" text-dark">Program Iformation</h3>
            <table class="table table-striped table-hover" s>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Duration</th>
                    <th>Type</th>
                    <th>Department</th>
                    <th>Faculty</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$program->en_name}}</td>
                    <td>{{$program->duration}} years</td>
                    <td>{{$program->type}}</td>
                    <td>{{$department->en_name}}</td>
                    <td>{{$faculty->en_name}}</td>
                </tr>
                </tbody>
            </table>
            <br>
            <h3 class="">Coordinators</h3>
            <br>
            @if(count($coordinators) > 0)

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Academic degree</th>
                        <th scope="col">Job</th>
                        <th scope="col">Start Date</th>
                    </tr>
                    </thead>
                    @foreach($coordinators as $staff)
                        <tbody id="staff">
                        <tr>
                            <td>{{$staff->en_name}}</td>
                            <td>{{$staff->degree}}</td>
                            <td>{{$staff->job}}</td>
                            <td>{{$staff->start_date}}</td>

                        </tr>
                        </tbody>
                    @endforeach
                </table>
            @else
                <br><br>
                <div class="alert alert-danger col-md-9">
                    <p>This Department Doesn't Have Any Staff</p>
                </div>
            @endif

        </div>
        <br>
        <div style="overflow: hidden" class="">
            <h3>Program Vision</h3>
            <p style="font-size: 16px" class="col-md-9">{{$program->vision}}</p>
        </div>
        <br>
        <div style="overflow: hidden" class="">
            <h3>Program Mission</h3>
            <p style="font-size: 16px" class="col-md-9">{{$program->mession}}</p>
        </div>
        <br>
        {{--<div class="col-md-11">--}}
            {{--<h3>Faculty Aim</h3>--}}
            {{--<table class="table table-striped table-hover col-md-11">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th scope="col">ID</th>--}}
                    {{--<th scope="col">Faculty Aim</th>--}}


                {{--<tbody id="contents">--}}
                {{--<td></td>--}}
                {{--<td><strong>Upon successful completion of program, the graduate should be able to:</strong></td>--}}
                {{--@foreach($program_aims as $content)--}}
                    {{--<tr id="{{$content->id}}">--}}
                        {{--<td scope="row">{{$content->id}}</td>--}}
                        {{--<td>{{$content->en_content}}</td>--}}
                    {{--</tr>--}}
                {{--</tbody>--}}
                {{--@endforeach--}}
                {{--</tr>--}}
                {{--</thead>--}}

            {{--</table>--}}
        {{--</div>--}}
        <br>
        <div class="col-md-11">
            <h3 class="text-center text-dark pull-left">Program Aims</h3>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Content</th>

                </tr>
                </thead>
                <tbody id="contents">
                @foreach($program_aims as $content)

                    <tr id="{{$content->id}}">
                        <th scope="row">{{$content->id}}</th>
                        <td>{{$content->en_content}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <br>
        <div class="col-md-11">
            <h3>Program NARS with Program ILOs</h3>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Genre</th>
                    <th scope="col">ID</th>
                    <th>National Academic References Standards (NARS)</th>
                    <th>Program Intended Learning Outcomes (ILOs)</th>
                </tr>
                </thead>
                @foreach($program_ilos as $content)
                    <tbody id="contents">
                    <tr id="{{$content->id}}">
                        <td>{{$content->genre}}</td>
                        <th scope="row">{{$content->id}}</th>
                        <td>{{$content->en_content}}</td>
                        <td>{{$content->update}}</td>
                    </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        <br>
        <br>
        <div style="overflow: hidden" class="col-md-11">
            <h3>Department Staff Members</h3>
            @if(count($all_staff) > 0)

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Academic degree</th>
                        <th scope="col">Job</th>
                        <th scope="col">Start Date</th>
                    </tr>
                    </thead>
                    @foreach($all_staff as $staff)
                        <tbody id="staff">
                        <tr>
                            <td>{{$staff->en_name}}</td>
                            <td>{{$staff->degree}}</td>
                            <td>{{$staff->job}}</td>
                            <td>{{$staff->start_date}}</td>
                           </tr>
                        </tbody>
                    @endforeach
                </table>

            @else
                <br><br>
                <div class="alert alert-danger col-md-9">
                    <p>This Department doesn't have any staff</p>
                </div>
            @endif

        </div>
        {{--<button class="btn btn-danger" onclick="javascript: window.print()">Download pdf</button>--}}
    </div></div>

@endsection