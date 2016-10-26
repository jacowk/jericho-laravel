@extends('layouts.master')

@section('title')
	Search Roles
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-role', 'class' => 'form-horizontal')) }}
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
				@if (!empty($roles) && count($roles) > 0)
					<h4 class="panel-title">Roles Search Result ({{ $roles->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Roles Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ROLE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($roles) && count($roles) > 0)
						@foreach($roles as $role)
						<tr>
							<td>{{ $role->id }}</td>
							<td>{{ $role->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ROLE))
								<td><a href="{{ route('update-role', ['role_id' => $role->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-role', ['role_id' => $role->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No roles</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($roles) && count($roles) > 0)
					@if ($roles->hasMorePages())
						{{ $roles->appends(['name' => $name])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $roles->appends(['name' => $name])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($roles->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($roles->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $roles->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $roles->appends(['name' => $name])->url($roles->lastPage() - 1) }}"><span>{{ $roles->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $roles->appends(['name' => $name])->url($roles->lastPage()) }}"><span>{{ $roles->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $roles->lastPage(); $i++)
									<li class="{{ ($roles->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $roles->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ROLE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-role')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Role', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
