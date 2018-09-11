

@extends('layouts.app')
@section('title', 'Add Course')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Course</div>

                    <div class="panel-body">
                        <form id="ins_prog" class="form-horizontal" method="POST" action="/admin/course/{{$course->code}}/add-content">
                            {{ csrf_field() }}

                            <input type="hidden" name="course_code" value="{{$course->code}}">
                            <div class="form-group{{ $errors->has('en_content') ? ' has-error' : '' }}">
                                <label for="en_content" class="col-md-4 control-label">English Content</label>

                                <div class="col-md-6">
                                    <textarea name="en_content" class="form-control"></textarea>

                                    @if ($errors->has('en_content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('en_content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('ar_contnet') ? ' has-error' : '' }}">
                                <label for="ar_content" class="col-md-4 control-label">Arabic Content</label>

                                <div class="col-md-6">

                                    <textarea name="ar_content" class="form-control"></textarea>
                                    @if ($errors->has('ar_content'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ar_content') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
                                <label for="desc" class="col-md-4 control-label">Discription</label>

                                <div class="col-md-6">
                                    <input id="desc" type="text" class="form-control" name="desc">

                                    @if ($errors->has('desc'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('desc') }}</strong>
                                    </span>
                                    @endif
                                </div>
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
    </div>
@endsection
