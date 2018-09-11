@extends('adminlte::page')
@section('title', 'view Grade')
@section('content')
    @include('admin.grades.add')
    @include('admin.grades.update')
    <div class="container">

        <h2 class="text-center text-dark">Grade Information</h2>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_grade">
                Add grade
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Grade</th>
            </tr>
            </thead>
            @foreach($grades as $grade)
                <tbody id="grades">
                <tr id="{{$grade->id}}">
                    <td>{{$grade->en_name}}</td>
                    <td>

                        <button type="button" id="edit" data-id="{{$grade->id}}" class="btn btn-info"
                                data-toggle="modal" data-target="#edit_grade">
                            Edit
                        </button>
                        <a href="#" class="btn btn-danger" id="del" data-id="{{$grade->id}}">x</a>
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
        $('#ins_grade').on('submit', function (e) {
            e.preventDefault();
            $('#add-error').text('')
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            //

            $.ajax({
                type: post,
                url: url,
                data: data,
                dataType: 'json',
            })
                .done(function (data) {
                    var tr = $('<tr/>', {
                        id: data.id
                    });
                    tr.append($('<td/>', {
                        text: data.en_name
                    })).append($('<td/>', {
                        html:
                        '<a href="#" class="btn btn-info"" id="edit" data-id="' + data.id + ' "> Edit</a>' + ' ' +
                        '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + ' "> x</a>'
                    }));
                    $('#grades').append(tr);
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#add-error').text(val)
                    })
                })
        })

        // --------------- Delete Grade ---------------------
        $('body').delegate('#grades #del', 'click', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: 'post',
                url: '{{url("/")}}/admin/grade/delete',
                data: {id: id, "_token": "{{ csrf_token() }}"},

                success: function (data) {
                    console.log('success');
                    $('tr#' + id).remove();

                },
                error: function (data) {
                    console.log('fail');

                }
            })
        });

        // --------------------- edit Grade-----------------------------
        $('body').delegate('#grades #edit', 'click', function (e) {
            var id = $(this).data('id');
            console.log(id)
            $.ajax({
                type: 'get',
                url: '{{url("/")}}/admin/grade/edit',
                data: {id: id},

                success: function (data) {
                    console.log(data);
                    $('#update_grade').find('#id').val(data.id)
                    $('#update_grade').find('#en_name').val(data.en_name)
                    $('#edit_grade').modal('show');
                },
                error: function (data) {
                    console.log('fail');
                }
            })
        });
        // --------------------- update grade-----------------------------
        $('#update_grade').on('submit', function (e) {
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
                        $('#help-block').text(val)
                    })
                })
        })
    </script>
@endsection