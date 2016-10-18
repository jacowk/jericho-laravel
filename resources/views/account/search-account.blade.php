@extends('layouts.master')

@section('title')
	Search Accounts
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-account', 'class' => 'form-horizontal')) }}
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
				<h4 class="panel-title">Accounts Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ACCOUNT))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($accounts) && count($accounts) > 0)
						@foreach($accounts as $account)
						<tr>
							<td>{{ $account->id }}</td>
							<td>{{ $account->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ACCOUNT))
								<td><a href="{{ route('update-account', ['account_id' => $account->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-account', ['account_id' => $account->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No accounts</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ACCOUNT))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-account')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Account', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
