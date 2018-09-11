
@extends('layouts.app')
@section('title', 'Add Faculty')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add New Faculty</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('addFaculty') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('en_name') ? ' has-error' : '' }}">
                                <label for="en_name" class="col-md-4 control-label">English Name</label>

                                <div class="col-md-6">
                                    <input id="en_name" type="text" class="form-control" name="en_name" placeholder="English name" required autofocus>

                                    @if ($errors->has('en_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('en_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('ar_name') ? ' has-error' : '' }}">
                                <label for="ar_title" class="col-md-4 control-label">Arabic Name</label>

                                <div class="col-md-6">
                                    <input id="ar_name" type="text" class="form-control" name="ar_name" placeholder="arabic name" required autofocus>

                                    @if ($errors->has('ar_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('ar_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                <label for="capacity" class="col-md-4 control-label">Capacity</label>

                                <div class="col-md-6">
                                    <input id="capacity" type="text" class="form-control" name="capacity" placeholder="capacity" autofocus>

                                    @if ($errors->has('capacity'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('capacity') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                                <label for="fax" class="col-md-4 control-label">Fax</label>

                                <div class="col-md-6">
                                    <input id="fax" type="text" class="form-control" name="fax" placeholder="fax" autofocus>

                                    @if ($errors->has('fax'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                <label for="telephone" class="col-md-4 control-label">Telephone</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="text" class="form-control" name="telephone" placeholder="telephone">

                                    @if ($errors->has('telephone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
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
