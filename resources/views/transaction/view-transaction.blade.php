@extends('layouts.master')

@section('title')
	View Transaction
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $transaction->property_flip->id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<th class="col-sm-2 text-right">ID</th>
				<td>{{ $transaction->id }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Effective Date</th>
				<td>{{ $transaction->effective_date }}</td>
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Description</th>
				<td>{{ $transaction->description }}</td>
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Reference</th>
				<td>{{ $transaction->reference }}</td>
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Account</th>
				<td>
					@if ($transaction->transaction)
						{{ $transaction->transaction->name }}
					@endif
				</td>
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Transaction Type</th>
				<td>
					@if ($transaction->transaction_type)
						{{ $transaction->transaction_type->description }}
					@endif
				</td>
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Amount</th>
				<td>{{ MoneyUtil::toRandsAndFormat($transaction->amount) }}</td>
			</tr>
			@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
				<tr>
					<th class="col-sm-3 text-right">Created By</th>
					<td>
						@if ($transaction->created_by)
							{{ $transaction->created_by->firstname }} {{ $transaction->created_by->surname }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Created At</th>
					<td>{{ $transaction->created_at }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Updated By</th>
					<td>
						@if ($transaction->updated_by)
							{{ $transaction->updated_by->firstname }} {{ $transaction->updated_by->surname }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Updated At</th>
					<td>{{ $transaction->updated_at }}</td>						
				</tr>
			@endif
		</table>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => array('view-property-flip', $transaction->property_flip->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to View Property</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-transaction', $transaction->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Update Transaction</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection