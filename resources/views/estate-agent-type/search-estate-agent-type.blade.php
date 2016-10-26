@extends('layouts.master')

@section('title')
	Search Estate Agent Types
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-estate-agent-type', 'class' => 'form-horizontal')) }}
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
				@if (!empty($estate_agent_types) && count($estate_agent_types) > 0)
					<h4 class="panel-title">Estate Agent Types Search Result ({{ $estate_agent_types->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Estate Agent Types Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ESTATE_AGENT_TYPE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($estate_agent_types) && count($estate_agent_types) > 0)
						@foreach($estate_agent_types as $estate_agent_type)
						<tr>
							<td>{{ $estate_agent_type->id }}</td>
							<td>{{ $estate_agent_type->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ESTATE_AGENT_TYPE))							
								<td><a href="{{ route('update-estate-agent-type', ['estate_agent_type_id' => $estate_agent_type->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-estate-agent-type', ['estate_agent_type_id' => $estate_agent_type->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No estate agent types</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($estate_agent_types) && count($estate_agent_types) > 0)
					@if ($estate_agent_types->hasMorePages())
						{{ $estate_agent_types->appends(['description' => $description])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $estate_agent_types->appends(['description' => $description])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($estate_agent_types->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($estate_agent_types->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $estate_agent_types->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $estate_agent_types->appends(['description' => $description])->url($estate_agent_types->lastPage() - 1) }}"><span>{{ $estate_agent_types->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $estate_agent_types->appends(['description' => $description])->url($estate_agent_types->lastPage()) }}"><span>{{ $estate_agent_types->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $estate_agent_types->lastPage(); $i++)
									<li class="{{ ($estate_agent_types->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $estate_agent_types->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ESTATE_AGENT_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-estate-agent-type')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Estate Agent Type', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
