@extends('adminlte::page')
@section('title', 'View Staff')

@section('content')
    @include('admin.staff.update')
    <h2 class="text-center text-dark">Staff Information</h2>
    <table class="table table-striped table-hover col-md-10">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Mobile</th>
            <th scope="col">email</th>
            <th scope="col">Faculty</th>
            <th scope="col">Department</th>
            <th scope="col">Academic Degree</th>
            <th scope="col">Job</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$staff->en_name}}</td>
            <td>{{$staff->mobile}}</td>
            <td>{{$staff->email}}</td>
            <td>{{$staff->fac_name}}</td>
            <td>{{$staff->dep_name}}</td>
            <td>{{$staff->degree}}</td>
            <td>{{$staff->job}}</td>
            <td>
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit_staff" id="edit">Edit</a>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="row">
        @if(count($courses) != 0)
            @foreach($courses as $course)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{$course->en_title}}</h4>
                            <h4 class="card-title">{{$course->code}}</h4>
                            {{--<p class="card-text"></p>--}}
                            {{--<a href="{{url("admin/course/view/$course->code")}}" class="btn btn-primary">--}}
                                {{--more details</a>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-md-11">
                <div class="alert alert-danger text-center">This staff does not teach any courses now</div>
            </div>
        @endif
    </div>


@endsection
@section('js')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // --------------------- update faculty-----------------------------
        $('#upd_staff').on('submit', function (e) {
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
                    console.log('done')
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