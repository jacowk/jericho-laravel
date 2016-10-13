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
						{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name')) }}
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
						@for($i = 0; $i < count($estate_agents); $i++)
						<tr>
							<td>{{ $estate_agents[$i]->id }}</td>
							<td>{{ $estate_agents[$i]->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ESTATE_AGENT))
								<td><a href="{{ route('update-estate-agent', ['estate_agent_id' => $estate_agents[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-estate-agent', ['estate_agent_id' => $estate_agents[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
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
					<button type="submit" class="btn btn-default">Add Estate Agent</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
