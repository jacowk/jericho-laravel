@extends('layouts.master')

@section('title')
	Add Transaction
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $property_flip_id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-transaction', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('property_flip_id', $property_flip_id) }}
			
			<div class="form-group">
				{{  Form::label('effective_date', 'Effective Date', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('effective_date', '', array('class' => 'form-control', 'placeholder' => 'Effective Date')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('description', '', array('class' => 'form-control', 'placeholder' => 'Description')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('reference', 'Reference', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('reference', '', array('class' => 'form-control', 'placeholder' => 'Reference')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('account_id', 'Account', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('account_id', $accounts, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('transaction_type_id', 'Transaction Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('transaction_type_id', $lookup_transaction_types, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('amount', 'Amount', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('amount', '', array('class' => 'form-control', 'placeholder' => 'Amount')) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add Transaction', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
		<script type="text/javascript">
			$( function() {
			    $( "#effective_date" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $('#amount').inputmask('R 99999999.99', {
					numericInput: true
				});
			});
		</script>
	</div>
@endsection