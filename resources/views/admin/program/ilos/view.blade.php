@extends('adminlte::page')
@section('title', 'Program ILOs')
@section('content')
    @include('admin.program.ilos.add')
    <div class="col-md-11">

        <h2 class="text-center text-dark">Program ILOs Information</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th>Genre</th>
                <th>Content</th>
                <th>Update</th>


            </tr>
            </thead>
            @foreach($program_ilos as $content)
                <tbody id="contents">
                <tr id="{{$content->id}}">
                    <th scope="row">{{$content->id}}</th>
                    <td>{{$content->genre}}</td>
                    <td>{{$content->en_content}}</td>
                    <td>{{$content->update}}</td>
                    <td>
                        <button type="button" class="btn btn-primary " data-toggle="modal"
                                data-target="#edit_program_ilos">
                            Edit
                        </button>
                    </td>
                    <td>
                        <a href="#" class="btn btn-danger" id="del"
                           data-program_id="{{$content->program_id}}"
                           data-nars_id="{{$content->id}}"
                           data-genre_id="{{$content->genre_id}}">
                            <i class="fa fa-trash-o"></i>
                        </a>
                        <div class="modal fade" id="edit_program_ilos" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Program ilos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form class=" mx-auto" style="padding: 7px 5px" id="addProgramIlos-form"
                                              action="{{ route('editProgramIlos') }}" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input type="hidden" id="program_id" name="program_id"
                                                       value="{{$content->program_id}}">
                                                <input type="hidden" id="nars_ilos_id" name="nars_ilos_id"
                                                       value="{{$content->id}}">
                                                <input type="hidden" id="genre_id" name="genre_id"
                                                       value="{{$content->genre_id}}">

                                                <label for="DropdownFormUpdate">update</label>
                                                <textarea type="text" name="update" rows="5" class="form-control"
                                                          id="DropdownFormUpdate">{{$content->update}}</textarea>
                                            </div>

                                            <input type="submit" class="btn btn-primary" value="Save">
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
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
        $('#ins_program_ilos').on('submit', function (e) {
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
                    console.log(data)
                    var tr = $('<tr/>', {
                        id: data.id
                    });
                    tr.append($('<td/>', {
                        text: data.id
                    })).append($('<td/>', {
                        text: data.en_content
                    })).append($('<td/>', {
                        html: '<a href="#" class="btn btn-success" id="edit" data-id="' + data.id + ' "> Edit</a>' + ' ' +
                        '<a href="#" class="btn btn-danger" id="del" data-id="' + data.id + ' "> Delete</a>'
                    }));
                    $('#contents').append(tr);
                }
            });
        });

        // --------------- Delete program ilos ---------------------
        $('body').delegate('#contents #del', 'click', function (e) {
            var program_id = $(this).data('program_id');
            var nars_id = $(this).data('nars_id');
            var genre_id = $(this).data('genre_id');
            console.log(program_id + ' , ' + nars_id + ' ' + genre_id);

            $.ajax({
                type: 'post',
                url: '{{url('/')}}/admin/program/del-ilos',
                data: {program_id: program_id, nars_id: nars_id, genre_id: genre_id, "_token": "{{csrf_token()}}"},
                success: function (data) {
                    console.log(data)
                    $('contents tr#' + nars_id).remove();
                    window.location.reload()
                },
                error: function (data) {
                    console.log(data)
                }
            })
        });


    </script>
@endsection