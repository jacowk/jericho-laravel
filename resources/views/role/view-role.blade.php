@extends('layouts.master')

@section('title')
	View Role
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-role') }}">Search Role</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $role->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Name</th>
					<td>{{ $role->name }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Permissions</th>
					<td>
						<table class="table table-bordered table-striped table-condensed">
							<tr>
								<th>Excluded Admin Permissions</th>
								<th>Admin Permissions</th>
								<th>Excluded Report Permissions</th>
								<th>Report Permissions</th>
							</tr>
							<tr>
								<td>
									@if ($excluded_admin_permissions)
										@foreach($excluded_admin_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No excluded admin permissions
									@endif
								</td>
								<td>
									@if ($admin_permissions)
										@foreach($admin_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No admin permissions
									@endif
								</td>
								<td>
									@if ($excluded_report_permissions)
										@foreach($excluded_report_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No excluded report permissions
									@endif
								</td>
								<td>
									@if ($report_permissions)
										@foreach($report_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No report permissions
									@endif
								</td>
							</tr>
							
							<tr>
								<th>Excluded Third Party Permissions</th>
								<th>Third Party Permissions</th>
								<th>Excluded Setup Permissions</th>
								<th>Setup Permissions</th>
							</tr>
							<tr>
								<td>
									@if ($excluded_third_party_permissions)
										@foreach($excluded_third_party_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No excluded third party permissions
									@endif
								</td>
								<td>
									@if ($third_party_permissions)
										@foreach($third_party_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No third permissions
									@endif
								</td>
								<td>
									@if ($excluded_lookup_permissions)
										@foreach($excluded_lookup_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No excluded setup permissions
									@endif
								</td>
								<td>
									@if ($lookup_permissions)
										@foreach($lookup_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No setup permissions
									@endif
								</td>
							</tr>
							
							<tr>
								<th>Excluded Property Permissions</th>
								<th>Property Permissions</th>
								<th>Excluded Global Permissions</th>
								<th>Global Permissions</th>
							</tr>
							<tr>
								<td>
									@if ($excluded_property_permissions)
										@foreach($excluded_property_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No excluded property permissions
									@endif
								</td>
								<td>
									@if ($property_permissions)
										@foreach($property_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No property permissions
									@endif
								</td>
								<td>
									@if ($excluded_global_permissions)
										@foreach($excluded_global_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No excluded global permissions
									@endif
								</td>
								<td>
									@if ($global_permissions)
										@foreach($global_permissions as $permission)
											{{ $permission->name }}<br>
										@endforeach
									@else
										No global permissions
									@endif
								</td>
							</tr>
						</table>
					</td>						
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($role->created_by)
								{{ $role->created_by->firstname }} {{ $role->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $role->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($role->updated_by)
								{{ $role->updated_by->firstname }} {{ $role->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $role->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-role', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Back to Search Role', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ROLE))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-role', $role->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Update Role', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
				
				<div class="form-group">
					{{  Form::open(array('route' => array('copy-role-permissions', $role->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Copy Role Permissions', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection