@extends('admin.layouts.main')

@push('styles')
    <!-- NProgress -->
    <link href="{{ chan::vendor('nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ chan::vendor('iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{ chan::vendor('bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ chan::vendor('pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{ chan::vendor('datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- NProgress -->
    <script src="{{ chan::vendor('nprogress/nprogress.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ chan::vendor('bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ chan::vendor('iCheck/icheck.min.js') }}"></script>
    <!-- PNotify -->
    <script src="{{ chan::vendor('pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ chan::vendor('pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ chan::vendor('pnotify/dist/pnotify.nonblock.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ chan::vendor('datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ chan::vendor('datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('livequery/jquery.livequery.js') }}"></script>
	<script>
		$(".progress .progress-bar")[0] && $(".progress .progress-bar").progressbar();
		@if(session()->has('text') and session()->has('type'))
		new PNotify({
			title: 'Task',
			text: "{{session('text')}}",
			type: "{{session('type')}}",
			styling: 'bootstrap3'
		});
		@endif
		function detail(id){
			alert(id);
		}
		var s = "<?= ($status!="0")?'?s='.$status:''; ?>";
		var t = "<?= ($parent!="0")?'?t='.$parent->id:''; ?>";
		$('#datatable-responsive').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax": "{{ url('data/task') }}"+s+t,
			"aLengthMenu": [[5, 10, 15, 20], [5, 10, 15, 20]],
			"iDisplayLength": 10
		} );
		$('.progress .progress-bar').livequery(function() {
			$(this).progressbar();
		});
		function canceled(id,title){
			$("#canceled").modal('show');
			$(".modal-title b").html(title);
		}
	</script>
@endpush

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
		<h2>
			Task
			<small>
				{!! ($parent!="0") ? 'Sub task of <b>'.$parent->title.'</b>' : $breadcrumb ; !!}
			</small>
		</h2>
		<ul class="nav navbar-right panel_toolbox">
		  @if($parent!='0')
		  <li>
			<a href="{{ url('task') }}" title="Back" data-toggle="tooltip" data-placement="top">
				<i class="fa fa-arrow-left"></i>
			</a>
		  </li>
		  @endif
		  <li>
			<a href="{{ url('task/create') }}{!! ($parent!='0') ? '?t='.$parent->id : '' ; !!}" title="Create" data-toggle="tooltip" data-placement="top">
				<i class="fa fa-plus"></i>
			</a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<p class="text-muted font-13 m-b-30">
		  <!---->
		</p>
		@if($parent!="0")
		<div class="x_panel" style="height: auto;">
		  <div class="x_title">
			<h2>
				Description
			</h2>
			<ul class="nav navbar-right panel_toolbox">
			  <li>
				<a class="collapse-link" title="Collapse" data-toggle="tooltip" data-placement="top">
					<i class="fa fa-chevron-up"></i>
				</a>
			  </li>
			</ul>
			<div class="clearfix"></div>
		  </div>
		  <div class="x_content" style="display:none;">
			<p class="text-muted font-13 m-b-30">
				{!! $parent->description !!}
			</p>
		  </div>
		</div>		
		<br/>
		<br/>
		@endif
		<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th width="5%">No</th>
					<th width="30%">Task</th>
					<th width="65%">Progress</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	  </div>
	</div>
</div>
@endsection

@section('modal')
<div id="canceled" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="modal-title">undo cancel <b></b> ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm">Yes</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Nevermind</button>
      </div>
    </div>
  </div>
</div>
@endsection