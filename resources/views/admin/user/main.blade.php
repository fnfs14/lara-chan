@extends('admin.layouts.main')

@push('styles')
    <!-- Datatables -->
    <link href="{{ chan::vendor('datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ chan::vendor('datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
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
	<script>
		$("#datatable-responsive").DataTable();
	</script>
@endpush

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	  <div class="x_title">
		<h2>Responsive example<small>Users</small></h2>
		<ul class="nav navbar-right panel_toolbox">
		  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="#">Settings 1</a>
			  </li>
			  <li><a href="#">Settings 2</a>
			  </li>
			</ul>
		  </li>
		  <li><a class="close-link"><i class="fa fa-close"></i></a>
		  </li>
		</ul>
		<div class="clearfix"></div>
	  </div>
	  <div class="x_content">
		<p class="text-muted font-13 m-b-30">
		  Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
		</p>
		
		<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
		  <thead>
			<tr>
			  <th>First name</th>
			  <th>Last name</th>
			  <th>Position</th>
			  <th>Office</th>
			  <th>Age</th>
			  <th>Start date</th>
			  <th>Salary</th>
			  <th>Extn.</th>
			  <th>E-mail</th>
			</tr>
		  </thead>
		  <tbody>
			<tr>
			  <td>Tiger</td>
			  <td>Nixon</td>
			  <td>System Architect</td>
			  <td>Edinburgh</td>
			  <td>61</td>
			  <td>2011/04/25</td>
			  <td>$320,800</td>
			  <td>5421</td>
			  <td>t.nixon@datatables.net</td>
			</tr>
			<tr>
			  <td>Garrett</td>
			  <td>Winters</td>
			  <td>Accountant</td>
			  <td>Tokyo</td>
			  <td>63</td>
			  <td>2011/07/25</td>
			  <td>$170,750</td>
			  <td>8422</td>
			  <td>g.winters@datatables.net</td>
			</tr>
		  </tbody>
		</table>
		
		
	  </div>
	</div>
</div>
@endsection