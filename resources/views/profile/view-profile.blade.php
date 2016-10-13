@extends('layouts.master')

@section('title')
	Profile
@endsection

@section('breadcrumb')

@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $user->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Firstname</th>
					<td>{{ $user->firstname }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Surname</th>
					<td>{{ $user->surname }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Email</th>
					<td>{{ $user->email }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Roles</th>
					<td>
						@if ($user->roles)
							@foreach($user->roles as $role)
								{{ $role->name }}<br>
							@endforeach
						@endif
					</td>
				</tr>
			</table>
		</div>
		<!-- 
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => array('update-user', $user->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Update User</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
		</div>
		 -->
	</div>
@endsection