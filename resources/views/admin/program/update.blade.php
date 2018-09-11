@extends('adminlte::page')
@section('title', 'View Program')
@section('content')

<h2>Edit Program</h2>
                <form id="update_prog" class="form-horizontal" method="POST" action="{{ route('editProgram') }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{$program->id}}" name="id">
                    <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                        <label for="en_name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="en_name" type="text" class="form-control" value="{{$program->en_name}}" name="en_name" required autofocus>

                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                        <label for="duration" class="col-md-4 control-label">Duration</label>

                        <div class="col-md-6">
                            <input id="duration" type="text" class="form-control" value="{{$program->duration}}" name="duration" required>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="col-md-4 control-label">Type</label>

                        <div class="col-md-6">
                            <input id="type" value="{{$program->type}}" type="text" class="form-control" name="type" required>

                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="vision" class="col-md-4 control-label">Vision</label>

                        <div class="col-md-6">
                            <textarea id="vision"  rows="5" class="form-control" name="vision">{{$program->vision}}</textarea>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="mission" class="col-md-4 control-label">Mission</label>

                        <div class="col-md-6">
                            <textarea id="mission" type="text" rows="5" class="form-control" name="mession">{{$program->mession}}</textarea>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <span class="help-block">
                            <strong id="update-error" style="color: #F00"></strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        // // --------------------- Update PROGRAM-----------------------------
        $('#update_prog').on('submit', function (e) {
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
                    history.back(1);
                })
                .fail(function (data) {
                    e.preventDefault();
                    $.each(data.responseJSON, function (index, val) {
                        console.log(val)
                        $('#update-error').text(val)
                    })
                })
        })

    </script>
@endsection