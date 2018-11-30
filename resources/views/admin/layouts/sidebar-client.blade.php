<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
	<!--<h3>General</h3>-->
	<ul class="nav side-menu">
	  <li>
		<a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home </a>
	  </li>
	  <li>
		<a><i class="glyphicon glyphicon-tasks"></i> Task <span class="fa fa-chevron-down"></span></a>
		<ul class="nav child_menu">
		  <li><a href="{{ url('task/create') }}">Create</a></li>
		  <li><a href="{{ url('task') }}">All Data</a></li>
		  <li><a href="{{ route('not_started_yet') }}">Not Started Yet</a></li>
		  <li><a href="{{ route('on_progress') }}">On Progress</a></li>
		  <li><a href="{{ route('done') }}">Done</a></li>
		  <li><a href="{{ route('canceled') }}">Canceled</a></li>
		  <li><a href="#">Log</a></li>
		</ul>
	  </li>
	</ul>
  </div>
</div>