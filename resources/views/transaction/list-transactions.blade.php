<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Transactions</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-1 text-center">Effective Date</th>
					<th class="col-sm-2 text-center">Description</th>
					<th class="col-sm-2 text-center">Reference</th>
					<th class="col-sm-2 text-center">Transaction Type</th>
					<th class="col-sm-1 text-center">Amount</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($property_flip->transactions) && count($property_flip->transactions) > 0)
					@foreach($property_flip->transactions as $transaction)
					<tr>
						<td>{{ $transaction->id }}</td>
						<td>{{ $transaction->effective_date }}</td>
						<td>{{ $transaction->description }}</td>
						<td>{{ $transaction->reference }}</td>
						<td>
							@if ($transaction->transaction_type)
								{{ $transaction->transaction_type->description }}
							@endif
						</td>
						<td>{{ MoneyUtil::toRandsAndFormat($transaction->amount) }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION))
							<td><a href="{{ route('update-transaction', ['transaction_id' => $transaction->id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-transaction', ['transaction_id' => $transaction->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="8">No transactions</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@if (PermissionValidator::hasPermission(PermissionConstants::ADD_TRANSACTION))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-transaction', $property_flip->id))) }}
				{{ Form::token() }}
				{{ Form::submit('Add Transaction', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endif