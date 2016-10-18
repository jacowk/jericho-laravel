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
				<h4 class="panel-title">Estate Agents Search Result</h4>
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
