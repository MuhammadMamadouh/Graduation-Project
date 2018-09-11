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
        .container{
            font-size: 18px;
        }
    </style>
@endsection
@section('title', 'NARS ILOs')
@section('content')
    {{--@include('admin.program.ilos.add')--}}
    <div class="col-md-11">

        <h2 class="text-center text-dark">Program ILOs Information</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th>Genre</th>
                <th>Content</th>


            </tr>
            </thead>
            @foreach($program_ilos as $content)
                <tbody id="contents">
                <tr id="{{$content->id}}">
                    <th scope="row">{{$content->id}}</th>
                    <td>{{$content->genre}}</td>
                    <td>{{$content->update}}</td>
                    <td>
                        <form id="add-form" action="{{route('addCourseIlos')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="program_id" name="program_id"
                                   value="{{$content->program_id}}">
                            <input type="hidden" id="nars_ilos_id" name="nars_ilos_id"
                                   value="{{$content->id}}">
                            <input type="hidden" id="program_id" name="genre_id"
                                   value="{{$content->NARS_ILOs_genre_id}}">
                            <input type="hidden" id="course_code" name="course_code"
                                   value="{{$course_code}}">
                            <input type="submit" value="Add to my course" class="btn btn-primary"
                                   @foreach($course_ilos as $ilo)
                                   @if($course_code == $ilo->course_code && $content->id == $ilo->program_ILOs_NARS_ILOs_id)
                                   disabled
                                    @endif
                                    @endforeach
                            >
                        </form>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
        <br>
    </div>

@endsection
@section('js')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#addCourseIlos').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            //

            $.ajax({
                type: post,
                url: url,
                data: data,
                dataType: 'json',
                success: function (data) {
                    console.log(data)

                }
            });
        });


        // --------------- Delete course ilos ---------------------
        $('body').delegate('#contents #del', 'click', function (e) {
            var program_id = $(this).data('program_id');
            var nars_id = $(this).data('nars_id');
            var genre_id = $(this).data('genre_id');
            var course_code = $(this).data('course_code');

            console.log(nars_id, program_id, genre_id, course_code);


            $.ajax({
                type: 'post',
                url: '/mycourse/del-ilos',
                data: {
                    program_id: program_id, nars_id: nars_id, genre_id: genre_id,
                    course_code: course_code, "_token": "{{csrf_token()}}"
                },
                success: function (data) {
                    console.log(data)
                    window.location.reload();
                    // $('tr#'+nars_id).remove();
                },
                error: function (data) {
                    console.log(data)
                }
            })
        });


    </script>
@endsection