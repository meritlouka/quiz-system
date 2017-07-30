@extends('layouts.quiz_layout')

@section('content')
    @include('admin.admin_tab')
    @include('settings.settings_tab')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Question</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" name="questionform" method="POST" action="{{ url('/storeTrueFalse') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="question" class="col-md-4 control-label">Please Enter Your Question</label>

                            <div class="col-md-6">
                                <textarea name="comment" form="questionform" rows="4" cols="50">Enter text here...</textarea>
                        
                                @if ($errors->has('question'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="checkbox" name="category" value="Bike"> I have a bike<br>
                                
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                       
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Answer1</label>

                            <div class="col-md-6">
                                <input id="answer" disabled   type="text" class="form-control" name="answer" value="true">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                             <input type="radio" name="is_correct" value="true">Correct Answer
                        </div>

                         
  
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Answer2</label>

                            <div class="col-md-6">
                                <input id="answer" disabled type="text" class="form-control" name="answer" value="false">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input type="radio" name="is_correct" value="true">Correct Answer<br>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Add Question
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
