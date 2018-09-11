@extends('adminlte::page')
@section('title', 'NARS ILOS')

@section('sidebar')
    <li class="treeview" id="ilo">

        <a href="#">
            <i class="fa fa-fw fa-circle-o "></i>
            <span>Types of ILOs </span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
        </a>
        <ul class="treeview-menu">
            @foreach($genres as $genre)
                <li class="">
                    <a href="{{url("admin/nars-ilos/$genre->id")}}">
                        <i class="fa fa-fw fa-circle-o "></i>
                        <span>{{$genre->en_title}}</span>
                    </a>
                </li>
            @endforeach
        </ul>

    </li>
@endsection
@section('content')
    @include('admin.nars.ilos.add')
    @include('admin.nars.ilos.update')

    <h2 class="text-center text-dark">NARS ilos Information</h2>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_nars_ilos">
            Add content
        </button>
    </div>
    <div class="btn-group">
    </div>
        <br>
        <table class="table table-striped table-hover col-md-11">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Content</th>
                <th scope="col">Type</th>
            </tr>
            </thead>
            @foreach($nars as $content)
                <tbody id="contents">
                <tr id="{{$content->id}}">
                    <th scope="row">{{$content->id}}</th>
                    <td>{{$content->en_content}}</td>
                    <td>{{$content->en_title}}</td>
                    <td>
                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit_nars_aims" id="edit"
                           data-id="{{$content->id}}">Edit</a>
                        <a href="#" class="btn btn-danger" id="del" data-id="{{$content->id}}">x</a>
                    </td>

                    {{--if user is a department admin and his department has program which he need to add nars aims to it--}}
                    <td>@if(isset($programs))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle btn btn-primary" data-toggle="dropdown">
                                    Add to program
                                </a>
                                {{--style="display: none;"--}}
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($programs as $program)
                                        <li>
                                            <a class="dropdown-item btn-primary" href="#" onclick="event.preventDefault();
                                                     document.getElementById('addProgramAims-form').submit();"></a>
                                            <form id="addProgramAims-form" action="{{ route('addProgramIlos') }}"
                                                  method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="program_id" name="program_id"
                                                       value="{{$program->id}}">
                                                <input type="hidden" id="nars_ilos_id" name="nars_ilos_id"
                                                       value="{{$content->id}}">
                                                <input type="hidden" id="genre_id" name="genre_id"
                                                       value="{{$content->genre_id}}">


                                                <input type="submit" class="btn btn-primary"
                                                       @foreach($program_ilos as $aim)
                                                       @if($program->id == $aim->program_id && $content->id == $aim->NARS_ILOs_id)
                                                       disabled
                                                       @endif
                                                       @endforeach
                                                       value="{{$program->en_name}}">
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
        <br>
        <div class="text-center">
            {{ $nars->links() }}
        </div>

        @endsection
        @section('js')
            <script type="text/javascript">

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#ins_nars_ilos').on('submit', function (e) {
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
                            window.location.reload()
                            // var tr = $('<tr/>', {
                            //     id: data.id
                            // });
                            // tr.append($('<td/>', {
                            //     text: data.id
                            // })).append($('<td/>', {
                            //     text: data.en_content
                            // })).append($('<td/>', {
                            //     text: data.en_title
                            // })).append($('<td/>', {
                            //     html: '<a href="#" class="btn btn-success" id="edit" data-id="' + data.id + ' "> Edit</a>' + ' ' +
                            //     '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + ' ">x</a>'
                            // }));
                            // $('#contents').append(tr);
                        }
                    });
                });

                // --------------------- Edit NARS-ILOs -----------------------------
                $('body').delegate('#contents #edit', 'click', function (e) {
                    var id = $(this).data('id');
                    console.log($('#upd_nars_ilos').find('#genre_id option:selected').val())
                    $.get('{{url("/")}}/admin/nars-ilos/edit', {id: id}, function (data) {
                        console.log(data);
                        $('#upd_nars_ilos').find('#id').val(data.id);
                        $('#upd_nars_ilos').find('#en_content').val(data.en_content);
                        $('#upd_nars_ilos').find('#genre_id').val("" + data.genre_id);

                        $('#edit_nars_ilos').modal('show');
                    })
                });
                // --------------------- update-----------------------------
                $('#upd_nars_ilos').on('submit', function (e) {
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
                            window.location.reload();
                            // console.log(data)
                            // var tr = $('<tr/>', {
                            //     id: data.id
                            // });
                            // tr.append($('<td/>', {
                            //     text: data.id
                            // })).append($('<td/>', {
                            //     text: data.en_content
                            // })).append($('<td/>', {
                            //     text: data.en_title
                            // })).append($('<td/>', {
                            //     html:
                            //     '<a href="#" class="btn btn-success" id="edit" data-id="' + data.id + '">Edit</a>' + ' ' +
                            //     '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + '">x</a>'
                            // }));
                            // $('#contents tr#' + data.id).replaceWith(tr);
                        })
                        .fail(function (data) {
                            $.each(data.responseJSON, function (index, val) {
                                console.log(val)
                                $('#update-error').text(val)
                            })
                        })
                })

                // --------------------- Delete Aim-----------------------------
                $('body').delegate('#contents #del', 'click', function (e) {
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'post',
                        url: '{{url("/")}}/admin/nars-ilos/delete',
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

            </script>
@endsection