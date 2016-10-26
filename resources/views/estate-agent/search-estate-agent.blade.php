@extends('layouts.master')

@section('title')
	Search Estate Agents
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-estate-agent', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('name', $name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
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
				@if (!empty($estate_agents) && count($estate_agents) > 0)
					<h4 class="panel-title">Estate Agents Search Result ({{ $estate_agents->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Estate Agents Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ESTATE_AGENT))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($estate_agents) && count($estate_agents) > 0)
						@foreach($estate_agents as $estate_agent)
						<tr>
							<td>{{ $estate_agent->id }}</td>
							<td>{{ $estate_agent->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ESTATE_AGENT))
								<td><a href="{{ route('update-estate-agent', ['estate_agent_id' => $estate_agent->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-estate-agent', ['estate_agent_id' => $estate_agent->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No estate agents</td>
						</tr>
					@endif
				</tbody>
			</table>
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($estate_agents) && count($estate_agents) > 0)
					@if ($estate_agents->hasMorePages())
						{{ $estate_agents->appends(['name' => $name])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $estate_agents->appends(['name' => $name])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($estate_agents->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($estate_agents->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $estate_agents->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $estate_agents->appends(['name' => $name])->url($estate_agents->lastPage() - 1) }}"><span>{{ $estate_agents->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $estate_agents->appends(['name' => $name])->url($estate_agents->lastPage()) }}"><span>{{ $estate_agents->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $estate_agents->lastPage(); $i++)
									<li class="{{ ($estate_agents->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $estate_agents->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ESTATE_AGENT))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-estate-agent')) }}
					{{ csrf_field() }}
					{{ Form::submit('Add Estate Agent', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
