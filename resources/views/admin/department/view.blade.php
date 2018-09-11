@extends('adminlte::page')
@section('title', 'view department')
@section('nav-items')
    <li class="pull-left">
        <a href="#" class="nav-item ">Staff</a>
    </li>
@endsection
@section('sidebar')
    <li class="header text-center">MAIN NAVIGATION</li>
    <li class="">
        <a href="{{URL::current()}}/coordinators">
            <i class="fa fa-fw fa-weibo"></i>
            <span>Coordinators</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
    <li class="">
        <a href="{{URL::current()}}/staffs">
            <i class="fa fa-fw fa-weibo"></i>
            <span>Staff</span>
            <span class="pull-right-container">
            <span class="label label-success pull-right"></span>
        </span>
        </a>
    </li>
@endsection

@section('content')
    @include('admin.program.add')
    <div class="col-4">
        <h2 class="text-center text-dark">{{$department->en_name}}</h2>
        <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#add_prog">
            Add Program
        </button>
    </div>
    <p id="msg" style="display: none" class="alert alert-success col-sm-4"></p>

    <div id="programs"></div>
    @alert_delete()
    <br>
@endsection
@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            $('#programs').load('{{url(\URL::current())}}/programs').fadeIn('slow');


            $('#ins_prog').on('submit', function (e) {
                e.preventDefault();
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
                        $('#programs').load('{{url(\URL::current())}}/programs').fadeIn('slow');
                        $('#add_prog').fadeOut(1000).modal('hide');
                        $('#msg').show();
                        $('#msg').html('Program has been inserted successfully');
                        $('#msg').fadeOut(2000);

                    })
                    .fail(function (data) {
                        $.each(data.responseJSON, function (index, val) {
                            console.log(val)
                            $('#add-error').text(val)
                        })
                    })
            });
            // --------------- Delete program ---------------------
            $('body').delegate('#program-info #del', 'click', function (e) {
                var id = $(this).data('id');
                $('#confirm').on('click', function (e) {
                    $.ajax({
                        type: 'post',
                        url: '{{url("/")}}/admin/program/delete',
                        data: {id: id, "_token": "{{ csrf_token() }}"},

                        success: function (data) {
                            $('#del_diag').modal('hide');
                            $('#msg').show();
                            $('#msg').html('Program has been deleted successfully');
                            $('#msg').fadeOut(3000);
                            $('#programs').load('{{url(\URL::current())}}/programs');
                        },
                        error: function (data) {
                            console.log('fail');
                        }
                    })
                })
            });
        })
    </script>
@endsection