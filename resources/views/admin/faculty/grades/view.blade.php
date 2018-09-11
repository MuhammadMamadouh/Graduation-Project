@extends('adminlte::page')
@section('title', 'view NARS')
@section('content')
    @include('admin.faculty.grades.add')
    @include('admin.faculty.grades.edit')
    <div class="container">

        <h2 class="text-center text-dark">Grades Of Faculty</h2>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_grade">
                Edit
            </button>
        </div>
        <table class="table table-striped table-hover col-md-7">
            <thead>
            <tr>
                <th scope="col">Content</th>
                <th scope="col">Percentage</th>
            </tr>
            </thead>
            @foreach($faculty_grades as $content)
                <tbody id="Grades">

                <tr id="{{$content->id}}">

                    <td>{{$content->en_name}}</td>
                    <td>{{$content->pivot->minimum_percentage}}</td>
                    <td data-faculty="{{$content}}"></td>
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
        // --------------- Delete Faculty Aim ---------------------
        $('body').delegate('#grades #del', 'click', function (e) {
            var id = $(this).data('id');
            $.post('{{URL::to("admin/faculty/grades/delete")}}', {
                id: id,
                "_token": '{{csrf_token()}}'
            }, function (data) {
                $('tr#' + id).remove();
                console.log(data);
            })
        });

        // ADD AIMS OF FACULTY
        // $('#frm_ins_grades').on('submit', function (e) {
        //     e.preventDefault();
        //     var data = $(this).serialize();
        //     var url = $(this).attr('action');
        //     var post = $(this).attr('method');
        //     $.ajax({
        //         type: 'POST',
        //         url: url,
        //         data: data,
        //         dataType: 'json'
        //     })
        //         .done(function (data) {
        //             console.log(data)
        //             var tr = $('<tr/>', {
        //                 id: data.id
        //             });
        //             tr.append($('<td/>', {
        //                 text: data.en_name
        //             })).append($('<td/>', {
        //                 text: data.minimum_percentage
        //             })).append($('<td/>', {
        //                 html:
        //                 '<a href="#" class="btn btn-success" id="edit" data-id="' + data.id + '">Edit</a>' + ' ' +
        //                 '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + '">x</a>'
        //             }));
        //             $('#Grades').append(tr);
        //             // window.location.reload();
        //         })
        //         .fail(function (data) {
        //             $.each(data.responseJSON, function (index, val) {
        //                 console.log(val)
        //                 $('#help-block').text(val)
        //             })
        //         })
        // });

        /**
         * Edit Faculty aim
         */
        $('body').delegate('#grades #edit', 'click', function (e) {
            var id = $(this).data('id');
            // var faculty_id = $(this).data('faculty');
            $.get('{{url("/")}}/admin/faculty/grades/' + id + '/edit', function (data) {
                console.log(data.en_content);
                $('#update_aim').find('#id').val(data.id);
                $('#update_aim').find('#content').val(data.en_content);
                $('#edit_aim').modal('show');
            })
        });
        // --------------------- update faculty Aim-----------------------------
        $('#update_aim').on('submit', function (e) {
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
                    console.log(data)
                    var tr = $('<tr/>', {
                        id: data.id
                    });
                    tr.append($('<td/>', {
                        text: data.en_content
                    })).append($('<td/>', {
                        html:
                        '<a href="#" class="btn btn-success" id="edit" data-id="' + data.id + '">edit</a>' + ' ' +
                        '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + '">delete</a>'
                    }));
                    $('#grades tr#' + data.id).replaceWith(tr);
                    window.location.reload();
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#error-block').text(val)
                    })
                })
        })

    </script>
@endsection