@extends('adminlte::page')
@section('title', 'View Course')
@section('content')
    @include('admin.course.add_staff')
    @include('admin.course.update')
    <div class="container">

        <h2 class="text-center text-dark">{{$course->en_title}} Course Information</h2>
        <br>
        <div>
            <button data-toggle="modal" data-target="#add_teacher" class="btn btn-primary">Add Teacher</button>
        </div>
        <br>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Title</th>
                <th scope="col">Weakly hours</th>
                <th scope="col">Students</th>
                <th scope="col">Year</th>
                <th scope="col">Semester</th>
                <th scope="col">Program</th>
                <th scope="col">Department</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$course->code}}</th>
                <td>{{$course->en_title}}</td>
                <td>{{$course->weakly_hour}}</td>
                <td>{{$course->students}}</td>
                <td>{{$year->name}}</td>
                <td>{{$semester->name}}</td>
                <td>{{$program->en_name}}
                <td>{{$department->en_name}}
                </td>
                <td>
                    <button data-toggle="modal" data-target="#edit_course" class="btn btn-info">Edit</button>
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="contents">

            <h3>Teachers</h3>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Academic Degree</th>
                </tr>
                </thead>
                <tbody id="teachers">
                @foreach($staff as $doc)
                    <tr id="{{$doc->id}}">
                        <td>{{$doc->en_name }}</td>
                        <td>{{$doc->degree}}</td>
                        <td>
                            <a href="{{route('viewStaff',['id'=> $doc->id])}}" class="btn btn-primary">view</a>
                            <button class="btn btn-danger" id="del"
                                    data-id="{{$doc->id}}" data-course_code="{{$course->code}}">x
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $('#faculties').change(function () {
            $('#departs').empty();
            $('#staff').empty();

            var selected = $(this).find('option:selected').attr('value');
            var url = '{{url("/")}}/admin/department/view-all/f=' + selected;
            $.get(url, function (data) {
                $('#departs').empty().append(data)
            });
            $('#departs').change(function () {
                var selected = $(this).find('option:selected').attr('value');
                var url = '{{url("/")}}/admin/staff/view-all/d=' + selected;
                $.get(url, function (data) {
                    $('#staff').empty().append(data)

                })
            });
            $('#staff').change(function () {
                var selected = $(this).find('option:selected').attr('value');
                console.log(selected)

            });
        })


        // --------------------- delete Teacher-----------------------------
        $('body').delegate('#teachers #del', 'click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var course_code = $(this).data('course_code');
            console.log(id, course_code);

            $.ajax({
                type: 'post',
                url: '{{url("/")}}/admin/course/del-teacher',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {staff_id: id, course_code: course_code, "_token": "{{ csrf_token() }}"},

                success: function (data) {
                    console.log(data);
                    $('tr#' + id).remove();
                },
                error: function (data) {
                    console.log('fail');

                }
            })
        });

        $('#addTeacher').on('submit', function (e) {

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
                    window.location.reload();
                })
                .fail(function (data) {
                    console.log(data.responseText)
                    window.location.reload();
                    $('#addTeacher-error').text(data.responseText)
                    if (data.responseText === "success") {
                        window.location.reload();
                    }

                })
        });

        // --------------------- update Course-----------------------------
        $('#update_course').on('submit', function (e) {
            e.preventDefault();
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
                    console.log('done');
                    window.location.reload();
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#update-error').text(val)
                    })
                })
        })

    </script>
@endsection