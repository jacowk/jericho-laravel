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
						{{ Form::text('firstname', $firstname, array('class' => 'form-control', 'placeholder' => 'Firstname')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('surname', 'Surname', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('surname', $surname, array('class' => 'form-control', 'placeholder' => 'Surname')) }}
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
						@foreach($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td>{{ $user->firstname }}</td>
							<td>{{ $user->surname }}</td>
							<td>{{ $user->email }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_USER))
								<td><a href="{{ route('update-user', ['user_id' => $user->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-user', ['user_id' => $user->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="6">No users</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($users) && count($users) > 0)
					@if ($users->hasMorePages())
						{{ $users->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $users->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@for ($i = 1; $i <= $users->lastPage(); $i++)
								<li class="{{ ($users->currentPage() == $i) ? ' active' : '' }}">
									<a href="{{ $users->url($i) }}"><span>{{ $i }}</span></a>
								</li>
							@endfor
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_USER))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-user')) }}
					{{ Form::token() }}
					{{ Form::submit('Add User', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
