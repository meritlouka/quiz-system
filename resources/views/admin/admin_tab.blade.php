<ul class="nav navbar-nav navbar-right">
      	<li><a href="#">hello ,{{ Auth::user()->username }}</a></li>
		<li><a href="#">Quiz Homepage</a></li>
		<li class="dropdown">
                <a  tabindex="-1" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Manage Questions<span class="caret"></span></a>
                <ul class="dropdown-menu multi-level">
                  <li class="dropdown-submenu" >
	                  	<a tabindex="-1" href="#" class="dropdown-toggle">Create a Question<span class="caret"></span></a>
	                    <ul class="dropdown-menu">
	                  	  <li><a tabindex="-1" href="/questions/createTrueFalse">True/False</a></li>
	                  	  <li><a tabindex="-1" href="#">Multiple Choice</a></li>
	                    </ul> 
                  </li>
                  <li><a tabindex="-1" href="/questions">View All Questions</a></li>
                  <li><a tabindex="-1" href="#">Edit a Question</a></li>
                </ul>
        </li>
		<li><a href="#">Quiz Management</a></li>
		<li><a href="/settings">Settings</a></li>
</ul>


