@extends('layouts.master')

@section('title')
	Link Attorney Contact
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $property_flip_id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-link-attorney-contact', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('property_flip_id', $property_flip_id) }}
			
			<div class="form-group">
				{{  Form::label('attorney_id', 'Attorney', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('attorney_id', $attorneys, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('contact_id', 'Contact', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('contact_id', $contacts, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('lookup_attorney_type_id', 'Attorney Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('lookup_attorney_type_id', $lookup_attorney_types, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Link Attorney Contact', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#attorney_id').on('change', function() {
				var attorney_id = $("#attorney_id").val();
				var url = "{{ asset('ajax-attorney-contacts')  }}";
				$.getJSON(url, {attorney_id: attorney_id, ajax: 'true'}, function(data) {
					  //console.log(data);
					  $("select#contact_id").empty();
					  $("select#contact_id").append('<option value="-1">Select Attorney Contact</option>');
					  $.each(data, function(key, val) {
						  $("select#contact_id").append('<option value="' + key + '">' + val + '</option>');
					  });
				});
			});
		});
	</script>
@endsection