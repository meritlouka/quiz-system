<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <script language="Javascript" type="text/javascript" src="{{URL::asset('js/edit_area/edit_area_full.js')}}"></script>
    <script language="Javascript" type="text/javascript">
        // initialisation
        editAreaLoader.init({
            id: "example_1" // id of the textarea to transform      
            ,start_highlight: true  // if start with highlight
            ,allow_resize: "both"
            ,allow_toggle: true
            ,word_wrap: true
            ,language: "en"
            ,syntax: "php"  
        });
        
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
        
        editAreaLoader.init({
            id: "example_3" // id of the textarea to transform  
            ,start_highlight: true  
            ,font_size: "8"
            ,font_family: "verdana, monospace"
            ,allow_resize: "y"
            ,allow_toggle: false
            ,language: "fr"
            ,syntax: "css"  
            ,toolbar: "new_document, save, load, |, charmap, |, search, go_to_line, |, undo, redo, |, select_font, |, change_smooth_selection, highlight, reset_highlight, |, help"
            ,load_callback: "my_load"
            ,save_callback: "my_save"
            ,plugins: "charmap"
            ,charmap_default: "arrows"
                
        });
        
        editAreaLoader.init({
            id: "example_4" // id of the textarea to transform      
            //,start_highlight: true    // if start with highlight
            //,font_size: "10"  
            ,allow_resize: "no"
            ,allow_toggle: true
            ,language: "de"
            ,syntax: "python"
            ,load_callback: "my_load"
            ,save_callback: "my_save"
            ,display: "later"
            ,replace_tab_by_spaces: 4
            ,min_height: 350
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
                open_file1();
                open_file2();
            }
        }
        
        function open_file1()
        {
            var new_file= {id: "to\\ é # € to", text: "$authors= array();\n$news= array();", syntax: 'php', title: 'beautiful title'};
            editAreaLoader.openFile('example_2', new_file);
        }
        
        function open_file2()
        {
            var new_file= {id: "Filename", text: "<a href=\"toto\">\n\tbouh\n</a>\n<!-- it's a comment -->", syntax: 'html'};
            editAreaLoader.openFile('example_2', new_file);
        }
        
        function close_file1()
        {
            editAreaLoader.closeFile('example_2', "to\\ é # € to");
        }
        
        function toogle_editable(id)
        {
            editAreaLoader.execCommand(id, 'set_editable', !editAreaLoader.execCommand(id, 'is_editable'));
        }
    
    </script>
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">Instruction Page</a></li>
                    <li><a href="2">Quiz Page</a></li>
                    <li><a href="index.html">Result Page</a></li>
                    <li><a href="login">Login Page</a></li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())

						
		  
                    @else
                        <li><a href="admin">Admin Page</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
</body>
</html>
