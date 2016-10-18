@extends('layouts.master')

@section('title')
	Search Transaction Typees
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-transaction-type', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('description', $description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
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
			<div class="panel-heading">
				<h4 class="panel-transaction-type">Transaction Types Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION_TYPE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($transaction_types) && count($transaction_types) > 0)
						@foreach($transaction_types as $transaction_type)
						<tr>
							<td>{{ $transaction_type->id }}</td>
							<td>{{ $transaction_type->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION_TYPE))
								<td><a href="{{ route('update-transaction-type', ['transaction_type_id' => $transaction_type->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-transaction-type', ['transaction_type_id' => $transaction_type->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No transaction types</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_TRANSACTION_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-transaction-type')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Transaction Type', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
