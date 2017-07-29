<!-- Stored in resources/views/layouts/master.blade.php -->

<html>
    <head>
        <title>Quiz System</title>
        
    </head>
    <body>
    	<header>
   
			<h2><a href="/">Instruction Page</a></h1>
			<h2><a href="2">Quiz Page</a></h1>
			<h2><a href="index.html">Result Page</a></h1>
			<h2><a href="index.html">Login Page</a></h1>
			<h2><a href="admin">Admin Page</a></h1>
		  
		</header>
      

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>