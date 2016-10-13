@extends('layouts.master')

@section('title')
	Add Suburb
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-suburb') }}">Search Suburb</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-suburb', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			<div class="form-group">
				{{  Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('box_code', 'Box Code', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('box_code', '', array('class' => 'form-control', 'placeholder' => 'Box Code')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('street_code', 'Street Code', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('street_code', '', array('class' => 'form-control', 'placeholder' => 'Street Code')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('area', 'Area', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('area_id', $areas, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add Suburb', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
	<script type="text/javascript">
		/* https://gist.github.com/imranismail/10200241
		$(document).ready(function(){
			src = "{{ url('autocomplete-areas') }}";
			
			$("#area_value").autocomplete({
				source: function( request, response ) {
                    $.ajax({
                        url: src,
                        dataType: "jsonp",
                        data: {
                            area: request.area_value
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
	            minLength:1
	        });			
		});*/
	</script>
@endsection