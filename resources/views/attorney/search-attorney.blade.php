@extends('layouts.master')

@section('title')
	Search Attorneys
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-attorney', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					<label class="control-label col-sm-2" for="name">Name:</label>
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
				<h4 class="panel-title">Attorneys Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ATTORNEY))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($attorneys) && count($attorneys) > 0)
						@for($i = 0; $i < count($attorneys); $i++)
						<tr>
							<td>{{ $attorneys[$i]->id }}</td>
							<td>{{ $attorneys[$i]->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ATTORNEY))
								<td><a href="{{ route('update-attorney', ['attorney_id' => $attorneys[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-attorney', ['attorney_id' => $attorneys[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
					@else
						<tr>
							<td colspan="4">No attorneys</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ATTORNEY))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-attorney')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Attorney</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
