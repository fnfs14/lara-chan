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
	<!-- LiveQuery -->
    <script src="{{ asset('livequery/jquery.livequery.js') }}"></script>
    <!-- jQuery Knob -->
    <script src="{{ chan::vendor('jquery-knob/dist/jquery.knob.min.js') }}"></script>
	<script>
		var _offset = 0;
		var _parent = "{{ $parent }}";
		var _url = "{{ url('task') }}";
		var _urlData = "{{ url('data/task') }}";
		var _countAllData = {{ chan::countData('task.task','parent',$parent) }};
		@if(session()->has('text') and session()->has('type'))
			_pNotify('Task',"{{session('text')}}","{{session('type')}}");
		@endif
	</script>
	<script src="{{ asset('js/admin/task/index.js') }}"></script>
@endpush

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
		<h2 class="ws-normal">
			Task
			<small>
				{!! $breadcrumb !!}
			</small>
		</h2>
		<ul class="nav navbar-right panel_toolbox">
		  @if($parent!="0")
		  <li>
			<a href="{{ url('task') }}{!! ($data->parent!='0') ? '/'.$data->parent : '' ; !!}" title="Back" data-toggle="tooltip" data-placement="top">
				<i class="fa fa-arrow-left"></i>
			</a>
		  </li>
		  <li>
			<a href="{{ url('task') }}/{{ $data->id }}/edit" title="Edit" data-toggle="tooltip" data-placement="top">
				<i class="glyphicon glyphicon-edit"></i>
			</a>
		  </li>
		  <li>
			<a href="{{ url('task/create') }}?t={{$parent}}" title="Create" data-toggle="tooltip" data-placement="top">
				<i class="fa fa-plus"></i>
			</a>
		  </li>
		  <li data-toggle="modal" data-target="#description">
			<a title="Description" data-toggle="tooltip" data-placement="top">
				<i class="fa fa-info"></i>
			</a>
		  </li>
		  <li>
			<a title="Delete" data-toggle="tooltip" data-placement="top"
				onclick="doDelete('{{$data->id}}','{{$data->title}}')">
				<i class="fa fa-trash"></i>
			</a>
		  </li>
		  @else
		  <li>
			<a href="{{ url('task/create') }}" title="Create" data-toggle="tooltip" data-placement="top">
				<i class="fa fa-plus"></i>
			</a>
		  </li>
		  @endif
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content" id="x_content">
		<p class="text-muted font-13 m-b-30">
		  <!---->
		</p>
	  </div>
	</div>
</div>
@endsection

@section('modal')
@if($parent!="0")
<div id="description" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="modal-title"><strong>{{ $data->title }}</strong> Description</h4>
      </div>
      <div class="modal-footer">
		{!! $data->description !!}
      </div>
    </div>
  </div>
</div>
@endif
<div id="delete" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="modal-title">Delete <strong></strong> ?</h4>
      </div>
      <div class="modal-footer">
		{!! Form::open([
			'method' => 'DELETE',
			'url' => ['/task', 1]
		]) !!}
		<button type="submit" class="btn btn-sm btn-success">OK</button>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Nevermind</button>
		{!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<div id="perc" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
	  <div class="modal-header">
        <h4 class="modal-title">Progress <strong></strong></h4>
      </div>
      <div class="modal-body">
		<center>
        <input class="knob knob_progress" data-width="100" data-height="120" data-min="0" data-displayPrevious=true data-fgColor="#26B99A" value="0" />
		</center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-info">Detail</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection