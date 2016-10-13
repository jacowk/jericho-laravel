@extends('layouts.master')

@section('title')
	Link Contractor Contact
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $property_flip_id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-link-contact-contractor', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('property_flip_id', $property_flip_id) }}
			
			<div class="form-group">
				{{  Form::label('contractor_id', 'Contractor', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('contractor_id', $contractors, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('contact_id', 'Contact', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('contact_id', $contacts, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('lookup_contractor_type_id', 'Contractor Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('lookup_contractor_type_id', $lookup_contractor_types, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Link Contractor Contact</button>
				</div>
			</div>
		{{  Form::close() }}
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#contractor_id').on('change', function() {
				var contractor_id = $("#contractor_id").val();
				var url = "{{ asset('ajax-contact-contractors') }}";
				$.getJSON(url, {contractor_id: contractor_id, ajax: 'true'}, function(data) {
					  //console.log(data);
					  $("select#contact_id").empty();
					  $("select#contact_id").append('<option value="-1">Select Contractor Contact</option>');
					  $.each(data, function(key, val) {
						  $("select#contact_id").append('<option value="' + key + '">' + val + '</option>');
					  });
				});
			});

			$('#contractor_id').on('change', function() {
				var contractor_id = $("#contractor_id").val();
				var url = "{{ asset('ajax-contact-contractor-types') }}";
				$.getJSON(url, {contractor_id: contractor_id, ajax: 'true'}, function(data) {
					  //console.log(data);
					  $("select#lookup_contractor_type_id").empty();
					  $("select#lookup_contractor_type_id").append('<option value="-1">Select Contractor Type</option>');
					  $.each(data, function(key, val) {
						  $("select#lookup_contractor_type_id").append('<option value="' + key + '">' + val + '</option>');
					  });
				});
			});
		});
	</script>
@endsection