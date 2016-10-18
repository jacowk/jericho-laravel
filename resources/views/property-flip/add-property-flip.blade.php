@extends('layouts.master')

@section('title')
	Add Property Flip
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property', ['property_id' => $property->id]) }}">View Property</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-property-flip', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('property_id', $property->id) }}
			
			<div class="form-group">
				{{  Form::label('reference_number', 'Reference Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::number('reference_number', '', array('class' => 'form-control', 'placeholder' => 'Reference Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('title_deed_number', 'Title Deed Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('title_deed_number', '', array('class' => 'form-control', 'placeholder' => 'Title Deed Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('case_number', 'Case Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('case_number', '', array('class' => 'form-control', 'placeholder' => 'Case Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('seller_id', 'Seller', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('seller_id', $contacts, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('selling_price', 'Selling Price', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('selling_price', '', array('class' => 'form-control', 'placeholder' => 'Selling Price')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('seller_status_id', 'Seller Status', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('seller_status_id', $seller_statuses, '', ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('purchaser_id', 'Purchaser', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('purchaser_id', $contacts, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('purchase_price', 'Purchase Price', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('purchase_price', '', array('class' => 'form-control', 'placeholder' => 'Purchase Price')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('finance_status_id', 'Finance Status', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('finance_status_id', $finance_statuses, '', ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add Property Flip', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#selling_price').inputmask('R 99999999.99', {
				numericInput: true
			});

			$('#purchase_price').inputmask('R 99999999.99', {
				numericInput: true
			});
		});
	</script>
@endsection