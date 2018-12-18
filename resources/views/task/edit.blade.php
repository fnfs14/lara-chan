@extends('admin.layouts.main')

@push('styles')
@endpush

@push('scripts')
	<script src="{{ asset('ckeditor4full/ckeditor.js') }}"></script>
	<script src="{{ asset('js/admin/task/form.js') }}"></script>
@endpush

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
		<h2>
			Task
			<small>
				{!! $breadcrumb !!}
			</small>
		</h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li>
			<a href="{{ url('task') }}/{{ $data->id }}" title="Back" data-toggle="tooltip" data-placement="top">
				<i class="fa fa-arrow-left"></i>
			</a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<p class="text-muted font-13 m-b-30">
		  <!---->
		</p>          
			{!! Form::model($data, [
					'method' => 'PATCH',
					'url' => ['/task', $data->id],
					'class' => 'form-horizontal',
					'files' => true
				]) !!}
			<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
				{!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label txt-left']) !!}
				<div class="col-md-10">
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
					{!! $errors->first('title', '<p class="help-block">:message</p>') !!}
				</div>
			</div>  
			<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
				{!! Form::label('description', 'Description', ['class' => 'col-md-2 control-label txt-left']) !!}
				<div class="col-md-10">
					{!! Form::textarea('description', null, ['class' => 'form-control tarea-v', 'id' => 'description']) !!}
					{!! $errors->first('description', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-offset-2 col-md-1">
					{!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
				</div>
			</div>
        {!! Form::close() !!}
	  </div>
	</div>
</div>
@endsection