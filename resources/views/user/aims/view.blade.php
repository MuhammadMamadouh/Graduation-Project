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

@section('title', 'Course Aims')
@section('content')

        <h2 class="text-center text-dark">Course Aims Information</h2>


        <a href="{{trim(URL::current(), 'aims').'program-aims'}}" class="btn btn-primary">Add</a>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Content</th>
                {{--<th scope="col">Update</th>--}}
            </tr>
            </thead>
            @foreach($course_aims as $content)
                <tbody id="contents">
                <tr id="{{$content->program_aims_nars_aim_id}}">
                    <th scope="row">{{$content->program_aims_nars_aim_id}}</th>
                    <td>{{$content->update}}</td>

                    <td>
                        <a href="#" class="btn btn-danger" id="del"
                           data-program_id="{{$content->program_aims_program_id}}"
                           data-nars_id="{{$content->program_aims_nars_aim_id}}"
                           data-course_code="{{$content->course_code}}"
                        > x</a>
                    </td>
                </tr>
                </tbody>
            @endforeach

            {{--{{dd($course_ilos)}}--}}
        </table>
        <br>
    </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        {{--// --------------- Add ILOs to Course -----------------------}}
        $('body').delegate('#contents #add_ilos', 'click', function (e) {
            var nars_id = $(this).data('nars_id');
            var genre_id = $(this).data('genre_id');
            var program_id = $(this).data('program_id');
            var course_code = $(this).data('course_code');

            console.log(nars_id, program_id, genre_id, course_code);

            $.post('{{URL::to("/mycourse/add-ilos")}}', {
                nars_id: nars_id,
                genre_id: genre_id,
                program_id: program_id,
                course_code: course_code,
            }, function (data) {
                console.log(data);
                $('#contents #add_ilos').text('added to Course ILOs').attr('disabled', true);
            })
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
                url: '{{url("/")}}/mycourse/del-aims',
                data: {
                    program_id: program_id, nars_id: nars_id,
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


        $('#ins_course_ilos').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            console.log(data);
            // $.ajax({
            //     type: post,
            //     url: url,
            //     data: data,
            //     dataTy: 'json',
            //     success: function (data) {
            //         console.log(data)
            //         $('#contents #add_course_ilos').text('added to Program').attr('disabled', true);
            //     }
            // });
        });
    </script>
@endsection