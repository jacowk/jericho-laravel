@extends('layouts.master')

@section('title')
	Update Milestones
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $milestone->property_flip_id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-milestone', $milestone->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					<p>{{ $milestone->id }}</p>
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('date_offer_made', 'Date Offer Made', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('date_offer_made', $milestone->date_offer_made, array('class' => 'form-control', 'placeholder' => 'Date Offer Made')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('date_of_acceptance', 'Date Of Acceptance', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('date_of_acceptance', $milestone->date_of_acceptance, array('class' => 'form-control', 'placeholder' => 'Date Of Acceptance')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('date_of_seller_signature', 'Date Of Seller Signature', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('date_of_seller_signature', $milestone->date_of_seller_signature, array('class' => 'form-control', 'placeholder' => 'Date Of Seller Signature')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('date_of_purchaser_signature', 'Date Of Purchaser Signature', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('date_of_purchaser_signature', $milestone->date_of_purchaser_signature, array('class' => 'form-control', 'placeholder' => 'Date Of Purchaser Signature')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('renovation_start_date', 'Renovation Start Date', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('renovation_start_date', $milestone->renovation_start_date, array('class' => 'form-control', 'placeholder' => 'Renovation Start Date')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('renovation_end_date', 'Renovation End Date', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('renovation_end_date', $milestone->renovation_end_date, array('class' => 'form-control', 'placeholder' => 'Renovation End Date')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('for_sale_date', 'For Sale Date', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('for_sale_date', $milestone->for_sale_date, array('class' => 'form-control', 'placeholder' => 'For Sale Date')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('sell_date', 'Sell Date', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('sell_date', $milestone->sell_date, array('class' => 'form-control', 'placeholder' => 'Sell Date')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('finance_status_id', 'Finance Status', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{  Form::select('finance_status_id', $finance_statuses, $milestone->finance_status_id, ['class' => 'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-default">Update Milestones</button>
				</div>
			</div>
		{{ Form::close() }}
		<script type="text/javascript">
			$( function() {
			    $( "#date_offer_made" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $( "#date_of_acceptance" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $( "#date_of_seller_signature" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $( "#date_of_purchaser_signature" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $( "#renovation_start_date" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $( "#renovation_end_date" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $( "#for_sale_date" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});

			    $( "#sell_date" ).datepicker({
			    	dateFormat: "yy-mm-dd"
				});
			});
		</script>
	</div>
@endsection