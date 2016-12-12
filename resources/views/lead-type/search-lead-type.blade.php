@extends('layouts.master')

@section('title')
	Search Lead Types
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-lead-type', 'class' => 'form-horizontal')) }}
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
				@if (!empty($lead_types) && count($lead_types) > 0)
					<h4 class="panel-title">Lead Types Search Result ({{ $lead_types->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Lead Types Search Result</h4>
				@endif
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
					@if (!empty($lead_types) && count($lead_types) > 0)
						@foreach($lead_types as $lead_type)
						<tr>
							<td>{{ $lead_type->id }}</td>
							<td>{{ $lead_type->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR_TYPE))
								<td><a href="{{ route('update-lead-type', ['lead_type_id' => $lead_type->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-lead-type', ['lead_type_id' => $lead_type->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No lead types</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($lead_types) && count($lead_types) > 0)
					@if ($lead_types->hasMorePages())
						{{ $lead_types->appends(['description' => $description])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $lead_types->appends(['description' => $description])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($lead_types->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($lead_types->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $lead_types->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $lead_types->appends(['description' => $description])->url($lead_types->lastPage() - 1) }}"><span>{{ $lead_types->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $lead_types->appends(['description' => $description])->url($lead_types->lastPage()) }}"><span>{{ $lead_types->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $lead_types->lastPage(); $i++)
									<li class="{{ ($lead_types->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $lead_types->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTRACTOR_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-lead-type')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Lead Type', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
