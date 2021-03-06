@extends('layouts.master')

@section('title')
	Update Property
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-property') }}">Search Property</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-property', $property->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $property->id }}</p>
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('address_line_1', 'Address Line 1', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('address_line_1', $property->address_line_1, array('class' => 'form-control', 'placeholder' => 'Address Line 1')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('address_line_2', 'Address Line 2', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('address_line_2', $property->address_line_2, array('class' => 'form-control', 'placeholder' => 'Address Line 2')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('address_line_3', 'Address Line 3', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('address_line_3', $property->address_line_3, array('class' => 'form-control', 'placeholder' => 'Address Line 3')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('address_line_4', 'Address Line 4', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('address_line_4', $property->address_line_4, array('class' => 'form-control', 'placeholder' => 'Address Line 4')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('address_line_5', 'Address Line 5', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('address_line_5', $property->address_line_5, array('class' => 'form-control', 'placeholder' => 'Address Line 5')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('area_id', 'Area', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($property->area)
						{{  Form::select('area_id', $areas, $property->area->id, ['class' => 'form-control']) }}
					@endif
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('suburb_id', 'Suburb', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($property->suburb)
						{{  Form::select('suburb_id', $suburbs, $property->suburb->id, ['class' => 'form-control']) }}
					@endif
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('greater_area_id', 'Greater Area', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($property->greater_area)
						{{  Form::select('greater_area_id', $greater_areas, $property->greater_area->id, ['class' => 'form-control']) }}
					@endif
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('portion_number', 'Portion Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::number('portion_number', $property->portion_number, array('class' => 'form-control', 'placeholder' => 'Portion Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('erf_number', 'Erf Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::number('erf_number', $property->erf_number, array('class' => 'form-control', 'placeholder' => 'Erf Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('size', 'Size', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::number('size', $property->size, array('class' => 'form-control', 'placeholder' => 'Size')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('lookup_property_type_id', 'Property Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('lookup_property_type_id', $lookup_property_types, $property->lookup_property_type_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Property', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#area_id').on('change', function() {
				var area_id = $("#area_id").val();
				var url = "{{ asset('ajax-retrieve-suburbs-for-area') }}";
				$.getJSON(url, {area_id: area_id, ajax: 'true'}, function(data) {
					  $("select#suburb_id").empty();
					  $("select#suburb_id").append('<option value="-1">Select Suburb</option>');
					  $.each(data, function(key, val) {
						  $("select#suburb_id").append('<option value="' + key + '">' + val + '</option>');
					  });
				});
			});
		});
	</script>
@endsection