@extends('layouts.master')

@section('title')
	Link Bank Contact
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $property_flip_id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-link-bank-contact', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('property_flip_id', $property_flip_id) }}
			
			<div class="form-group">
				{{  Form::label('bank_id', 'Bank', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('bank_id', $banks, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('contact_id', 'Contact', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('contact_id', $contacts, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Link Bank Contact', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#bank_id').on('change', function() {
				var bank_id = $("#bank_id").val();
				var url = "{{ asset('ajax-bank-contacts')  }}";
				$.getJSON(url, {bank_id: bank_id, ajax: 'true'}, function(data) {
					  //console.log(data);
					  $("select#contact_id").empty();
					  $("select#contact_id").append('<option value="-1">Select Bank Contact</option>');
					  $.each(data, function(key, val) {
						  $("select#contact_id").append('<option value="' + key + '">' + val + '</option>');
					  });
				});
			});
		});
	</script>
@endsection