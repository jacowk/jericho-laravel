@extends('layouts.master')

@section('title')
	Update Transaction
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $transaction->property_flip->id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-transaction', $transaction->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $transaction->id }}</p>
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('effective_date', 'Effective Date', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('effective_date', $transaction->effective_date, array('class' => 'form-control', 'placeholder' => 'Effective Date')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('description', $transaction->description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('reference', 'Reference', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('reference', $transaction->reference, array('class' => 'form-control', 'placeholder' => 'Reference')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('account_id', 'Account', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($transaction->account)
						{{  Form::select('account_id', $accounts, $transaction->account->id, ['class' => 'form-control']) }}
					@else
						{{  Form::select('account_id', $accounts, '', ['class' => 'form-control']) }}
					@endif
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('transaction_type_id', 'Transaction Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($transaction->transaction_type)
						{{  Form::select('transaction_type_id', $lookup_transaction_types, $transaction->transaction_type->id, ['class' => 'form-control']) }}
					@else
						{{  Form::select('transaction_type_id', $lookup_transaction_types, '', ['class' => 'form-control']) }}
					@endif
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('debit_amount', 'Debit Amount', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('debit_amount', $transaction->debit_amount, array('class' => 'form-control', 'placeholder' => 'Debit Amount')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('credit_amount', 'Credit Amount', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('credit_amount', $transaction->credit_amount, array('class' => 'form-control', 'placeholder' => 'Credit Amount')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Transaction', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
		<script type="text/javascript">
			$( function() {
			    $( "#effective_date" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $('#debit_amount').inputmask('R 99 999 999.99', {
					numericInput: true
				});

			    $('#credit_amount').inputmask('R 99 999 999.99', {
					numericInput: true
				});
			});
		</script>
	</div>
@endsection