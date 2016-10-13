@extends('layouts.master')

@section('title')
	Link Estate Agent Contact
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $property_flip_id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-link-contact-estate-agent', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('property_flip_id', $property_flip_id) }}
			
			<div class="form-group">
				{{  Form::label('estate_agent_id', 'Estate Agent', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('estate_agent_id', $estate_agents, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('contact_id', 'Contact', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('contact_id', $contacts, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('lookup_estate_agent_type_id', 'Estate Agent Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('lookup_estate_agent_type_id', $lookup_estate_agent_types, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Link Estate Agent Contact</button>
				</div>
			</div>
		{{  Form::close() }}
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#estate_agent_id').on('change', function() {
				var estate_agent_id = $("#estate_agent_id").val();
				var url = "{{ asset('ajax-contact-estate-agents') }}";
				$.getJSON(url, {estate_agent_id: estate_agent_id, ajax: 'true'}, function(data) {
					  //console.log(data);
					  $("select#contact_id").empty();
					  $("select#contact_id").append('<option value="-1">Select Estate Agent Contact</option>');
					  $.each(data, function(key, val) {
						  $("select#contact_id").append('<option value="' + key + '">' + val + '</option>');
					  });
				});
			});
		});
	</script>
@endsection