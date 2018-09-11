@extends('adminlte::page')
@section('title', 'View Semester')
@include('admin.semester.update')
@include('admin.course.add')
@section('content')

    <div class="container">
        <p id="msg" style="display: none" class="alert alert-success col-sm-4 pull-right"></p>
        <h2 class="text-center text-dark">Semester Information</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>

                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Start date</th>
                <th scope="col">End date</th>
                <th scope="col">Status</th>
                <th scope="col">Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$semester->id}}</th>
                <td>{{$semester->name}}</td>
                <td>{{$semester->start_date}}</td>
                <td>{{$semester->end_date}}</td>
                <td>{{$semester->status}}</td>
                <td>{{$semester->en_desc}}</td>
                <td><a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit_sem" id="edit">Edit</a>

                </td>
            </tr>
            </tbody>
        </table>
        <div>
            <button class="btn btn-info" data-toggle="modal" data-target="#add_course">Add Course</button>
        </div>
        <div>
            <h3>Courses</h3>
        </div>
        <div class="row" id="courses">

        </div>
    </div>
    @alert_delete()
@endsection
@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {


            $('#courses').load('{{URL::current()}}/courses');

            // --------------------- update Semester-----------------------------
            $('#update-sem').on('submit', function (e) {
                e.preventDefault();
                $('#update-error').empty();
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
                        console.log(data)
                        window.location.reload()

                    })
                    .fail(function (data) {

                        $.each(data.responseJSON, function (index, val) {
                            console.log(val);
                            $('#update-error').text(val)
                        })
                    })
            });
            $('#ins_course').on('submit', function (e) {
                e.preventDefault();
                $('#add-error').empty();
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
                        console.log(data)
                        $('#add_course').modal('hide');
                        $('#msg').show();
                        $('#msg').html('Course has been added successfully');
                        $('#msg').fadeOut(2000);
                        $('#courses').load('{{URL::current()}}/courses');
                    })
                    .fail(function (data) {

                        $.each(data.responseJSON, function (index, val) {
                            console.log(val);
                            $('#add-error').text(val)
                        })
                    })
            })

            // --------------- Delete  Course---------------------
            $('body').delegate('#courses #del', 'click', function (e) {
                var id = $(this).data('id');
                $('#confirm').on('click', function (e) {
                    $.ajax({
                        type: 'post',
                        url: '{{url("/")}}/admin/course/delete',
                        data: {id: id, "_token": "{{ csrf_token() }}"},

                        success: function (data) {
                            $('#del_diag').modal('hide');
                            $('#msg').show();
                            $('#msg').html('Course has been deleted successfully');
                            $('#courses').load('{{URL::current()}}/courses');
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