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
						{{ Form::text('description', $description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10"> 
						{{ Form::submit('Search', array('class' => 'btn btn-default')) }}
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
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($milestone_types) && count($milestone_types) > 0)
					@if ($milestone_types->hasMorePages())
						{{ $milestone_types->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $milestone_types->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@for ($i = 1; $i <= $milestone_types->lastPage(); $i++)
								<li class="{{ ($milestone_types->currentPage() == $i) ? ' active' : '' }}">
									<a href="{{ $milestone_types->url($i) }}"><span>{{ $i }}</span></a>
								</li>
							@endfor
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_MILESTONE_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-milestone-type')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Milestone Type', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
