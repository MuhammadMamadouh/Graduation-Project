@extends('adminlte::page')
@section('title', 'view genre')
@section('content')
    @include('admin.genre.add')
    @include('admin.genre.update')
    <div class="container">

        <h2 class="text-center text-dark">Genre Information</h2>
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_genre">
                Add genre
            </button>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Genre</th>
            </tr>
            </thead>
            @foreach($genres as $genre)
            <tbody id="genres">
            <tr id="{{$genre->id}}">
                <td>{{$genre->en_title}}</td>
                <td><a href="#" class="btn btn-success" id="edit" data-toggle="modal" data-target="#edit_genre " data-id="{{$genre->id}}"> Edit</a>
                    <a href="#" class="btn btn-danger" id="del" data-id="{{$genre->id}}"> x</a></td>

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
        $('#ins_genre').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');
            //

            $.ajax({
                type: post,
                url: url,
                data: data,
                dataTy: 'json',
                success: function (data) {
                    var tr = $('<tr/>', {
                        id: data.id
                    });
                    tr.append($('<td/>', {
                        text: data.en_title
                    })).append($('<td/>', {
                        html:
                        '<a href="#" class="btn btn-success" id="edit"  data-toggle="modal" data-target="#edit_genre " data-id="' + data.id + ' "> Edit</a>' + ' ' +
                        '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + ' "> x</a>'
                    }));
                    $('#genres').append(tr);
                }
            })
        })

        // --------------------- Delete genres-----------------------------
        $('body').delegate('#genres #del', 'click', function (e) {
            var id = $(this).data('id');
            $.ajax({
                type: 'post',
                url: '{{url("/")}}/admin/genre/delete',
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
        // --------------------- Edit Genre-----------------------------
        $('body').delegate('#genres #edit', 'click', function (e) {
            var id = $(this).data('id');
            $.get('{{url("/")}}/admin/genre/edit', {id:id}, function (data) {
                console.log(data);
                $('#upd_genre').find('#id').val(data.id);
                $('#upd_genre').find('#title').val(data.en_title);
                $('#edit_genre').modal('show');
            })
        });

        // --------------------- update-----------------------------
        $('#upd_genre').on('submit', function (e) {
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
                   // window.location.reload();
                    var tr = $('<tr/>', {
                        id: data.id
                    });
                    tr.append($('<td/>', {
                        text: data.en_title
                    })).append($('<td/>', {
                        html:
                        '<a href="#" class="btn btn-success" id="edit" data-id="' + data.id + '">Edit</a>' + ' ' +
                        '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + '">x</a>'
                    }));
                    $('#genres tr#' + data.id).replaceWith(tr);
                })
                .fail(function (data) {
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#update-error').text(val)
                    })
                })
        });


    </script>
@endsection