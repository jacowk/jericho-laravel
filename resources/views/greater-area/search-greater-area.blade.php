@extends('layouts.master')

@section('title')
	Search Greater Areas
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{  Form::open(array('route' => 'do-search-greater-area', 'class' => 'form-horizontal')) }}
				{{  Form::token() }}
				<div class="form-group">
					{{  Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{  Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10"> 
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</div>
			{{  Form::close() }}
		</div>
	</div><br/>
	<div class="container">
		<div class="row">
			<div class="panel-heading">
				<h4 class="panel-title">Greater Areas Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_GREATER_AREA))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($greater_areas) && count($greater_areas) > 0)
						@for($i = 0; $i < count($greater_areas); $i++)
						<tr>
							<td>{{ $greater_areas[$i]->id }}</td>
							<td>{{ $greater_areas[$i]->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_GREATER_AREA))
								<td><a href="{{ route('update-greater-area', ['greater_area_id' => $greater_areas[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-greater-area', ['greater_area_id' => $greater_areas[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
					@else
						<tr>
							<td colspan="4">No Greater Areas</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_GREATER_AREA))
		<div class="container">
			<div class="row">
				{{  Form::open(array('route' => 'add-greater-area')) }}
					{{  Form::token() }}
					<button type="submit" class="btn btn-default">Add Greater Area</button>
				{{  Form::close() }}
			</div>
		</div>
	@endif
@endsection
