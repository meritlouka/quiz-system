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
                    <form class="form-horizontal" role="form" name="questionform" method="POST" action="{{ url('questions/storeTrueFalse') }}">
                        {{ csrf_field() }}

                        
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                
								    <div class="input-group">
								   
								        <select class="form-control" name="category_id">
									        @foreach($categories as $category)

									            <option value="{{$category->id}}">{{$category->name}}</option>
									        @endforeach
									    </select>
								    </div>
                            </div>
                        </div>
                        

                        <fieldset>
						<legend>Example 2</legend>
						<p>Multi file mode example with syntax selection option. The highlight colors of the selected line is also shown.</p>
						<textarea id="example_2" style="height: 250px; width: 100%;" name="question">
						</textarea>
						<p>Custom controls:<br />
							<input type='button' onclick='open_file1()' value='open file 1' />
							<input type='button' onclick='open_file2()' value='open file 2' />
							<input type='button' onclick='close_file1()' value='close file 1' />
						</p>
					</fieldset>
                       
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
                            <input type="radio" name="is_correct" value="false">Correct Answer<br>
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
