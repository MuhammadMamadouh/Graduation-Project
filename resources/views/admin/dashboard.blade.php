@extends('adminlte::page')
@section('title', 'Dashboard')
@include('admin.faculty.add')
@include('admin.faculty.update')

@section('sidebar')
    <li class="header">Main</li>

    <li class="treeview">

        <a href="#" id="year">
            <i class="fa fa-fw fa-circle-o "></i>
            <span> Main Navigation </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu" id="years">
            <li class="treeview" id="year">

                <a href="#">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span> Degree </span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{route('viewDegrees')}}">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>view</span>
                        </a>
                    </li>

                </ul>

            </li>
            <li class="treeview" id="year">

                <a href="#">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span> Teaching Methods </span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{route('viewTeachMethods')}}">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>view</span>
                        </a>
                    </li>

                </ul>

            </li>
            <li class="treeview" id="jobs">

                <a href="#">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span> Jobs </span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{route('viewJobs')}}">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>view</span>
                        </a>
                    </li>

                </ul>

            </li>
            <li class="treeview" id="evalMethods">
                <a href="#">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span> Evaluation Methods </span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{route('viewEvalMethods')}}">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>view</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview" id="Facilties">
                <a href="#">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span> Facilities</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{route('facilityView')}}">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>view</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>


    {{--------------------- Nars -------------------}}
    <li class="treeview">

        <a href="#" id="year">
            <i class="fa fa-fw fa-circle-o "></i>
            <span> NARS Navigation </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu" id="Nars">
            <li class="treeview" id="aim">

                <a href="#">
                    <i class="fa fa-fw fa-circle-o "></i>
                    <span> Aims </span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="">
                        <a href="{{route('viewNarsAims')}}">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span>view</span>
                        </a>
                    </li>
                </ul>
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
                            <a href="/admin/nars-ilos/{{$genre->id}}">
                                <i class="fa fa-fw fa-circle-o "></i>
                                <span>{{$genre->en_title}}</span>
                            </a>
                        </li>
                    @endforeach
                    <li class="treeview" id="Facilties">
                        <a href="#">
                            <i class="fa fa-fw fa-circle-o "></i>
                            <span> Genres</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="">
                                <a href="{{route('viewGenres')}}">
                                    <i class="fa fa-fw fa-circle-o "></i>
                                    <span>view</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="header">Admins</li>
    <li class="">
        <a href="/admin/admins">
            <i class="fa fa-fw fa-weibo"></i>
            <span>view</span>
            <span class="pull-right-container">
    <span class="label label-success pull-right"></span>
    </span>
        </a>
    </li>
@endsection
@section('content')
    <div class="container">


        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add New Faculty
        </button>
        <p id="msg" style="display: none" class="alert alert-success col-sm-5 pull-right"></p>
        <div id="faculties">
        </div>
        @alert_delete()
    </div>

@endsection
@section('js')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#faculties').load('<?php echo url('admin/faculties')?>').fadeIn('fast');
        $(document).ready(function () {

            $('#frm-insert').on('submit', function (e) {
                e.preventDefault();
                $('#msg').show();
                $('#add-error').text('');
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json'
                })
                    .done(function (data) {
                        $('#exampleModal').modal('hide');
                        $('#msg').html('Faculty has been added successfully');
                        $('#msg').fadeOut(2000);
                        $('#faculties').load('<?php echo url('admin/faculties')?>').fadeIn('slow');
                    })
                    .fail(function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#add-error').text(val)
                        })
                    })
            });


            // --------------------- delete faculty-----------------------------
            $('body').delegate('#faculty-info #del', 'click', function (e) {
                var id = $(this).data('id');
                console.log(id)
                $('#confirm').on('click', function (e) {

                    $.ajax({
                        type: 'post',
                        url: '{{url('/admin/faculty/delete')}}',
                        data: {id: id, "_token": "{{ csrf_token() }}"},

                        success: function (data) {
                            $('#del_diag').modal('hide');
                            console.log('success');
                            $('#msg').show();
                            $('#msg').html('Faculty has been deleted successfully');
                            $('tr#' + id).remove();
                            $('#msg').fadeOut(2000);
                            $('#faculties').load('<?php echo url('admin/faculties')?>').fadeIn('slow');
                        },
                        error: function (data) {
                            console.log('fail');

                        }
                    })
                })
            });

            // --------------------- edit faculty-----------------------------
            $('body').delegate('#faculty-info #edit', 'click', function (e) {
                var id = $(this).data('id');
                $.get('{{url("/")}}/admin/faculty/' + id + '/edit', function (data) {
                    $('#frm-update').find('#id').val(data.id);
                    $('#frm-update').find('#en_name').val(data.en_name);
                    $('#frm-update').find('#fax').val(data.fax);
                    $('#frm-update').find('#telephone').val(data.telephone);
                    $('#faculty-update').modal('show');
                })
            });
            // --------------------- update faculty-----------------------------
            $('#frm-update').on('submit', function (e) {
                e.preventDefault();
                $('#update-error').text('')
                var data = $(this).serialize();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json'
                })
                    .done(function (data) {
                        $('#msg').show();
                        $('#msg').html('Faculty has been updated successfully');
                        $('#msg').fadeOut(2000);
                        $('#faculties').load('<?php echo url('admin/faculties')?>').fadeIn('slow');

                    })
                    .fail(function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#update-error').text(val)
                        })
                    })
            })
        });
    </script>
@endsection
