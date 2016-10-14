@extends('layouts.master')

@section('title')
	Update Milestone
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $milestone->property_flip->id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-milestone', $milestone->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $milestone->id }}</p>
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('milestone_type_id', 'Milestone Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('milestone_type_id', $lookup_milestone_types, $milestone->milestone_type_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('effective_date', 'Effective Date', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('effective_date', $milestone->effective_date, array('class' => 'form-control', 'placeholder' => 'Effective Date')) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Update Milestone</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<script type="text/javascript">
		$( function() {
		    $( "#effective_date" ).datepicker({
		    	dateFormat: "yy-mm-dd"
			});
		});
	</script>
@endsection