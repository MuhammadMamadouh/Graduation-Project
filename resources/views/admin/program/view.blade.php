@extends('adminlte::page')
@section('title', 'View Program')
@include('admin.year.add')
@section('sidebar')

    <li class="header">Main</li>
    <li class="">
        <a href="{{URL::current()}}/nars_aims">
            <i class="fa fa-fw fa-weibo"></i>
            <span>Nars Aims</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>NARS ILOs</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu">
            @foreach($genres as $genre)
                <li class="">
                    <a href="{{URL::current()}}/nars_ilos/{{$genre->id}}">
                        <i class="fa fa-fw fa-circle-o "></i>
                        <span>{{$genre->en_title}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="">
        <a href="{{URL::current()}}/ilos">
            <i class="fa fa-fw fa-weibo"></i>
            <span>Program ILOs</span>
            <span class="pull-right-container">
                <span class="label label-success pull-right"></span>
            </span>
        </a>
    </li>
    <li class="">
        <a href="{{URL::current()}}/aims">
            <i class="fa fa-fw fa-weibo"></i>
            <span>Program Aims</span>
            <span class="pull-right-container">
                <span class="label label-success pull-right"></span>
            </span>
        </a>
    </li>
    <li class="">
        <a href="{{\URL::current()}}/report">
            <i class="fa fa-fw fa-weibo"></i>
            <span>Program Report</span>
            <span class="pull-right-container">
                 <span class="label label-success pull-right"></span>
            </span>
        </a>
    </li>
    <li class="header text-center">YEARS</li>
    <li class="treeview">

        <a href="#" id="year">
            <i class="fa fa-fw fa-circle-o "></i>
            <span> Years </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>

        <ul class="treeview-menu" id="years">

            </li>
        </ul>
    <li class="">
        <a href="#" type="button" class="" data-toggle="modal" data-target="#add_year">
            <i class="fa fa-fw fa-plus"></i>
            <span>Add New Year</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>

@endsection
@section('content')

    <h2 class="text-center text-dark pull-left">Program {{$program->en_name}} Information</h2>
    <p id="msg" style="display: none" class="alert alert-success col-sm-4 pull-right"></p>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th>Name</th>
            <th>Duration</th>
            <th>Type</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{$program->id}}</th>
            <td>{{$program->en_name}}</td>
            <td>{{$program->duration}} years</td>
            <td>{{$program->type}}</td>

        </tr>
        </tbody>
    </table>
    <a href="{{Url::current()}}/edit" class="btn btn-info">Edit</a>
    <div class="container">
        <h2>Program Vision </h2>
        <p class="col-md-8" style="font-size:16px">
        @if(isset($program->vision))
            {{$program->vision}}
        @else
            <div class="alert-dark col-md-5">Program has not VISION yet
                you can add it <a href="{{Url::current()}}/edit" class="">here</a></div>
            @endif

            </p>
    </div>
    <div class="container">
        <h2>Program Mission</h2>
        <p class="col-md-8" style="font-size:16px ">
        @if(isset($program->mession))
            {{$program->mession}}
        @else
            <div class="alert-dark col-md-5">Program has not MISSION yet
                you can add it <a href="{{Url::current()}}/edit" class="">here</a></div>
            @endif

            </p>
    </div>
    <hr>
    @alert_delete()
@endsection
@section('js')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {


            $('#years').load('{{url(\URL::current())}}/years').fadeIn('slow');
            $('#frm-insert').on('submit', function (e) {

                e.preventDefault();
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.ajax({
                    type: post,
                    url: url,
                    data: data,
                    dataType: 'json',
                })
                    .done(function (data) {
                        console.log(data);
                        $('#add_year').modal('hide');
                        $('#years').load('{{url(\URL::current())}}/years').fadeIn('slow');
                        $('#msg').show();
                        $('#msg').html('Year has been added successfully');

                        $('#msg').fadeOut(2500);


                    })
                    .fail(function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#help-block').text(val)
                        })
                    })

            });

            $('body').delegate('#years #del', 'click', function (e) {
                var id = $(this).data('id');
                $('#confirm').on('click', function (e) {
                    console.log(id);
                    $.ajax({
                        type: 'post',
                        url: '{{url('/admin/year/delete')}}',
                        data: {id: id, "_token": "{{ csrf_token() }}"},

                        success: function (data) {
                            $('#del_diag').modal('hide');
                            $('#years').load('{{url(\URL::current())}}/years');
                            $('#msg').show();
                            $('#msg').html('Year has been deleted successfully');

                            $('#msg').fadeOut(2000);
                        },
                        error: function (data) {
                            $('#del_diag').modal('hide');
                            $('#msg').show();
                            $('#msg').removeClass('alert-success').addClass('alert-danger').html('something went wrong');
                            $('#msg').fadeOut(2000);
                        }
                    })
                })
            });
        });
    </script>
@endsection