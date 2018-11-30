<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Settings">
	<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="openFullscreen()" class="_fullscreen">
	<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Exit FullScreen" onclick="closeFullscreen()"
	class="_exitFullscreen" style="display: none;">
	<span class="glyphicon glyphicon-resize-small" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Lock">
	<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
  </a>
  <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="tooltip" data-placement="top" title="Logout"
	onclick="event.preventDefault();document.getElementById('logout-form').submit();">
	<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	@csrf
  </form>
</div>

<script>
/* Get the documentElement (<html>) to display the page in fullscreen */
var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
  $("._fullscreen").css('display','none');
  $("._exitFullscreen").css('display','block');
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
  $("._fullscreen").css('display','block');
  $("._exitFullscreen").css('display','none');
}
</script>