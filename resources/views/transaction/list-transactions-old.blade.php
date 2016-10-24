<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Transactions</h4>
		</div>
	</div>
	@foreach ($account_transactions as $account_id => $value)
		<div class="row">
			<div class="panel-heading text-center">
				<h4 class="panel-title">
					@if ($value[0]->name)
				</h4>
			</div>
		</div>
		<div class="row">
			Transactions
		</div>
	@endforeach
	
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
				@if (!empty($property_flip->transactions) && count($property_flip->transactions) > 0)
					@foreach ($property_flip->transactions as $transaction)
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
							@if ($profit_loss_balance > 0)
								Profit
							@elseif ($profit_loss_balance < 0)
								Loss
							@else
								Break Even
							@endif
						</th>
						<td colspan="4">{{ MoneyUtil::toRandsAndFormat($profit_loss_balance) }}</td>
					</tr>
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