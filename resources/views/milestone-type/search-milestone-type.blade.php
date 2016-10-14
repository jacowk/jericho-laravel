@extends('layouts.master')

@section('title')
	Search Milestone Types
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-milestone-type', 'class' => 'form-horizontal')) }}
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
			<div class="panel-heading text-center">
				<h4 class="panel-milestone-type">Milestone Types Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MILESTONE_TYPE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($milestone_types) && count($milestone_types) > 0)
						@foreach($milestone_types as $milestone_type)
						<tr>
							<td>{{ $milestone_type->id }}</td>
							<td>{{ $milestone_type->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MILESTONE_TYPE))
								<td><a href="{{ route('update-milestone-type', ['milestone_type_id' => $milestone_type->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-milestone-type', ['milestone_type_id' => $milestone_type->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No milestone types</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_MILESTONE_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-milestone-type')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Milestone Type</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
