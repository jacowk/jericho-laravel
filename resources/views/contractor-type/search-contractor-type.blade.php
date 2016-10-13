@extends('layouts.master')

@section('title')
	Search Contractor Types
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-contractor-type', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('description', '', array('class' => 'form-control', 'placeholder' => 'Description')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10"> 
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div><br/>
	<div class="container">
		<div class="row">
			<div class="panel-heading">
				<h4 class="panel-contractor-type">Contractor Types Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR_TYPE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($contractor_types) && count($contractor_types) > 0)
						@foreach($contractor_types as $contractor_type)
						<tr>
							<td>{{ $contractor_type->id }}</td>
							<td>{{ $contractor_type->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR_TYPE))
								<td><a href="{{ route('update-contractor-type', ['contractor_type_id' => $contractor_type->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-contractor-type', ['contractor_type_id' => $contractor_type->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No contractor types</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTRACTOR_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-contractor-type')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Contractor Type</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
