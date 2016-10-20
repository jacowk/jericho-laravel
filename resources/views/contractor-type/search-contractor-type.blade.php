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
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($contractor_types) && count($contractor_types) > 0)
					@if ($contractor_types->hasMorePages())
						{{ $contractor_types->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $contractor_types->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@for ($i = 1; $i <= $contractor_types->lastPage(); $i++)
								<li class="{{ ($contractor_types->currentPage() == $i) ? ' active' : '' }}">
									<a href="{{ $contractor_types->url($i) }}"><span>{{ $i }}</span></a>
								</li>
							@endfor
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTRACTOR_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-contractor-type')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Contractor Type', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
