@extends('layouts.master')

@section('title')
	View User
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-user') }}">Search User</a></li>
</ol>
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
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($user->created_by)
								{{ $user->created_by->firstname }} {{ $user->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $user->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($user->updated_by)
								{{ $user->updated_by->firstname }} {{ $user->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $user->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-user', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to Search User</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_USER))
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
			@endif
		</div>
	</div>
@endsection