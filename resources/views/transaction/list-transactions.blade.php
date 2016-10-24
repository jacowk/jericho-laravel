<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Transactions</h4>
		</div>
	</div>
	
	{{-- 
		In the following foreach, $account_transactions is an associative array:
			$account_id is the key.
			$account_with_transactions is an array containing an Account model, followed by an array of the 
			Transaction model, and then the account balance.
			$account_with_transactions[0] is the Account model
			$account_with_transactions[1] is the array of Transaction model
			$account_with_transactions[2] is the account balance
	--}}
	@foreach ($account_transactions as $account_id => $account_with_transactions)
		<div class="row">
			<div class="panel-heading text-center">
				<h4 class="panel-title">
					@if ($account_with_transactions[0])
						{{ $account_with_transactions[0]->name }}
					@endif
				</h4>
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
						<th class="col-sm-1 text-center">Debit Amount</th>
						<th class="col-sm-1 text-center">Credit Amount</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($account_with_transactions[1]) && count($account_with_transactions[1]) > 0)
						@foreach ($account_with_transactions[1] as $transaction)
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
							<td>{{ MoneyUtil::toRandsAndFormat($transaction->debit_amount) }}</td>
							<td>{{ MoneyUtil::toRandsAndFormat($transaction->credit_amount) }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION))
								<td><a href="{{ route('update-transaction', ['transaction_id' => $transaction->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-transaction', ['transaction_id' => $transaction->id]) }}">View</a></td>
						</tr>
						@endforeach
						<tr>
							<th class="text-right" colspan="5">
								@if ($account_with_transactions[2] > 0)
									Profit
								@elseif ($account_with_transactions[2] < 0)
									Loss
								@else
									Break Even
								@endif
							</th>
							<td colspan="4">{{ MoneyUtil::toRandsAndFormat($account_with_transactions[2]) }}</td>
						</tr>
					@else
						<tr>
							<td colspan="8">No transactions</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	@endforeach
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