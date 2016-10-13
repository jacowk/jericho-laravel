@extends('layouts.master')

@section('title')
	View Suburb
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-suburb') }}">Search Suburb</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $suburb->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Name</th>
					<td>{{ $suburb->name }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Box Code</th>
					<td>{{ $suburb->box_code }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Street Code</th>
					<td>{{ $suburb->street_code }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Area</th>
					<td>{{ $suburb->area->name }}</td>						
				</tr>
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-suburb', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to Search Suburb</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_SUBURB))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-suburb', $suburb->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Update Suburb</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection