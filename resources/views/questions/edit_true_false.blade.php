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
                    <form class="form-horizontal" role="form" name="questionform" method="POST" action="{{ url('questions/'.$question->id.'/update') }}">
                        {{ csrf_field() }}

                         <input id="id" class="form-control" name="id" type="hidden" value="{{isset($question)?$question->id:''}}">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                
                                    <div class="input-group">
                                   
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)

                                                <option value="{{$category->id}}"  {{ isset($question) && $question->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
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
                             <input type="radio" name="is_correct" value="true" {{ ($correctAnswer == 'True')? 'checked="checked"' : ''}} >Correct Answer
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
                            <input type="radio" name="is_correct" value="false" {{ ($correctAnswer == 'False')? 'checked="checked"' : ''}} >Correct Answer<br>
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
    <script language="Javascript" type="text/javascript">
       
        editAreaLoader.init({
            id: "example_2" // id of the textarea to transform  
            ,start_highlight: true
            ,allow_toggle: false
            ,language: "en"
            ,syntax: "html" 
            ,toolbar: "search, go_to_line, |, undo, redo, |, select_font, |, syntax_selection, |, change_smooth_selection, highlight, reset_highlight, |, help"
            ,syntax_selection_allow: "css,html,js,php,python,vb,xml,c,cpp,sql,basic,pas,brainfuck"
            ,is_multi_files: true
            ,EA_load_callback: "editAreaLoaded"
            ,show_line_colors: true
        });
       
        // callback functions
        function my_save(id, content){
            alert("Here is the content of the EditArea '"+ id +"' as received by the save callback function:\n"+content);
        }
        
        function my_load(id){
            editAreaLoader.setValue(id, "The content is loaded from the load_callback function into EditArea");
        }
        
        function test_setSelectionRange(id){
            editAreaLoader.setSelectionRange(id, 100, 150);
        }
        
        function test_getSelectionRange(id){
            var sel =editAreaLoader.getSelectionRange(id);
            alert("start: "+sel["start"]+"\nend: "+sel["end"]); 
        }
        
        function test_setSelectedText(id){
            text= "[REPLACED SELECTION]"; 
            editAreaLoader.setSelectedText(id, text);
        }
        
        function test_getSelectedText(id){
            alert(editAreaLoader.getSelectedText(id)); 
        }
        
        function editAreaLoaded(id){
            if(id=="example_2")
            {
                
                open_file2();
            }
        }
      
        
        function open_file2()
        {   
            var textBody = <?php echo (isset($question)&&isset($question->question))?"'".trim(str_replace( array("\r\n","\r","\n",'  '), '\n' ,addslashes($question->question)))."'"  : "'<html>'" ;?> ;
            var new_file= {id: "Filename", text: textBody, syntax: 'html'};
            editAreaLoader.openFile('example_2', new_file);
        }
        
      
        
        function toogle_editable(id)
        {
            editAreaLoader.execCommand(id, 'set_editable', !editAreaLoader.execCommand(id, 'is_editable'));
        }
    
    </script>
@endsection
