@extends('layouts.master')

@section('title')
	Search Users
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-user', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('firstname', 'Firstname', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('firstname', '', array('class' => 'form-control', 'placeholder' => 'Firstname')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('surname', 'Surname', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('surname', '', array('class' => 'form-control', 'placeholder' => 'Surname')) }}
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
				<h4 class="panel-title">Users Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-3 text-center">Firstname</th>
						<th class="col-sm-3 text-center">Surname</th>
						<th class="col-sm-3 text-center">Email</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_USER))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($users) && count($users) > 0)
						@for($i = 0; $i < count($users); $i++)
						<tr>
							<td>{{ $users[$i]->id }}</td>
							<td>{{ $users[$i]->firstname }}</td>
							<td>{{ $users[$i]->surname }}</td>
							<td>{{ $users[$i]->email }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_USER))
								<td><a href="{{ route('update-user', ['user_id' => $users[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-user', ['user_id' => $users[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
					@else
						<tr>
							<td colspan="6">No users</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_USER))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-user')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add User</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
