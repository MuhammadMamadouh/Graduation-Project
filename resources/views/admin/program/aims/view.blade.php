@extends('adminlte::page')
@section('title', 'Program Aims')
@section('content')
    @include('admin.program.aims.add')
    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{\Session::get('error')}}
        </div>
    @endif
    <h2 class="text-center text-dark">Program Aims Information</h2>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Content</th>
            <th scope="col">Update</th>
        </tr>
        </thead>
        @foreach($program_aims as $content)
            <tbody id="contents">
            <tr id="{{$content->id}}">
                <th scope="row">{{$content->id}}</th>
                <td>{{$content->en_content}}</td>
                <td>{{$content->update}}</td>
                <td><a href="#" class="btn btn-danger"  id="del"
                       data-program_id ="{{$content->program_id}}"
                        data-nars_id="{{$content->id}}"
                    >x</a>
                    <button type="button" class="btn btn-primary dropdown-toggle" id="edit-form" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Edit
                    </button>

                    <div class="dropdown-menu" style="min-width: 100%"  aria-labelledby="#edit-form">
                        <form class=" mx-auto" style="padding: 7px 5px" id="addProgramAims-form"
                              action="{{ route('editProgramAims') }}" method="POST">
                              {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" id="program_id" name="program_id"
                                       value="{{$content->program_id}}">
                                <input type="hidden" id="nars_aims_id" name="nars_aims_id"
                                       value="{{$content->id}}">

                                <label for="DropdownFormUpdate">update</label>
                                <textarea type="text" name="update" rows="5" class="form-control"
                                          id="DropdownFormUpdate">{{$content->update}}</textarea>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Save">
                        </form>
                        <div class="dropdown-divider"></div>
                    </div>

                </td>

            </tr>
            </tbody>
        @endforeach
    </table>
    <div class="text-center">
        {{$program_aims->links()}}
    </div>
@endsection
@section('js')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#ins_program_aims').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');

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

        // --------------- Delete program aim ---------------------
        $('body').delegate('#contents #del', 'click', function (e) {
            var program_id = $(this).data('program_id');
            var nars_id = $(this).data('nars_id');
            console.log(program_id + ' , ' + nars_id );

            $.ajax({
                type: 'post',
                url: '{{url("/admin/program/del-aims")}}',
                data: {program_id:program_id, nars_id:nars_id, "_token": "{{csrf_token()}}"},
                success: function(data){
                    console.log(data)
                    $('tr#'+nars_id).remove();
                },
                error: function (data) {
                    console.log(data)
                }
            })
        });


    </script>
@endsection