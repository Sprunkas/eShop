@extends('template')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">Registracija</div>
            <div class="panel-footer">
                <form action="{{ route('auth.register') }}" class="form-horizontal" method="POST">
                  <div class="form-group{{ $errors->has('username') ? ' has-error' : ''}}">
                    <label for="username" class="col-sm-2 control-label">Slapyvardis</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" name="username" placeholder="Slapyvardis">
                      @if($errors->has('username'))
                        <span class="help-block">{{ $errors->first('username') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                    <label for="password" class="col-sm-2 control-label">Slaptažodis</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Slaptažodis">
                      @if($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                    <label for="password_confirmation" class="col-sm-2 control-label">Pakartokit slaptažodį</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Pakartokit slaptažodį">
                      @if($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Registruotis</button>
                    </div>
                  </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </div>
@stop