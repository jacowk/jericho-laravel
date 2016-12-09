@extends('layouts.master')

@section('title')
	View Permission
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-permission') }}">Search Permission</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $permission->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Name</th>
					<td>{{ $permission->name }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Permission Type</th>
					<td>
						@if ($permission->permission_type)
							{{ $permission->permission_type->description }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Roles</th>
					<td>
						@if ($permission->roles)
							@foreach($permission->roles as $role)
								{{ $role->name }}<br>
							@endforeach
						@endif
					</td>						
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($permission->created_by)
								{{ $permission->created_by->firstname }} {{ $permission->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $permission->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($permission->updated_by)
								{{ $permission->updated_by->firstname }} {{ $permission->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $permission->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-permission', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Back to Search Permission', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PERMISSION))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-permission', $permission->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Update Permission', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection