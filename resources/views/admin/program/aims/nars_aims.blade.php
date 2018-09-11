@extends('adminlte::page')
@section('title', 'NARS Aims')
@section('content')
    @include('admin.nars.aims.add')
    @include('admin.nars.aims.update')
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{\Session::get('error')}}
        </div>
    @endif
    <h2 class="text-center text-dark">NARS Aims Information</h2>

    <table class="table table-striped table-hover col-md-11">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Content</th>
        </tr>
        </thead>
        @foreach($nars as $content)
            <tbody id="contents">
            <tr id="{{$content->id}}">
                <th scope="row">{{$content->id}}</th>
                <td>{{$content->en_content}}</td>


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
                                        <form id="addProgramAims-form" action="{{ route('addProgramAims') }}"
                                              method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" id="program_id" name="program_id"
                                                   value="{{$program->id}}">
                                            <input type="hidden" id="program_id" name="nars_aims_id"
                                                   value="{{$content->id}}">

                                            <input type="submit" class="btn btn-primary"
                                                   @foreach($program_aims as $aim)
                                                   @if($program->id == $aim->program_id && $content->id == $aim->nars_aims_id)
                                                   disabled
                                                   @endif
                                                   @endforeach
                                                   value="{{$program->en_name}}">
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif</td>
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
        $('#ins_nars_aims').on('submit', function (e) {
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
                    window.location.reload();
                }
            });
        });

        // --------------------- Edit NARS-Aims -----------------------------
        $('body').delegate('#contents #edit', 'click', function (e) {
            var id = $(this).data('id');
            $.get('{{url("/admin/nars-aims/edit")}}', {id: id}, function (data) {
                console.log(data);
                $('#upd_nars_aims').find('#id').val(data.id);
                $('#upd_nars_aims').find('#en_content').val(data.en_content);
                $('#edit_nars_aims').modal('show');
            })
        });
        // --------------------- update-----------------------------
        $('#upd_nars_aims').on('submit', function (e) {
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
                    window.location.reload();
                    // var tr = $('<tr/>', {
                    //     id: data.id
                    // });
                    // tr.append($('<td/>', {
                    //     text: data.id
                    // })).append($('<td/>', {
                    //     text: data.en_content
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
                url: '{{url("/admin/nars-aims/delete")}}',
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