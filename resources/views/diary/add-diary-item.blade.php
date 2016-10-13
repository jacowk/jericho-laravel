@extends('layouts.master')

@section('title')
	Add Diary Item
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $property_flip_id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-diary-item', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('property_flip_id', $property_flip_id) }}
			
			<div class="form-group">
				{{  Form::label('followup_date', 'Followup Date', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('followup_date', '', array('class' => 'form-control', 'placeholder' => 'Followup Date')) }}
				</div>
			</div>
			<div class="form-group">
				{{  Form::label('followup_user_id', 'Followup User', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('followup_user_id', $lookup_users, null, ['class' => 'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				{{  Form::label('comments', 'Comments', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::textarea('comments', '', array('class' => 'form-control', 'placeholder' => 'Comments')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Add Diary Item</button>
				</div>
			</div>
		{{  Form::close() }}
	</div>
	<script text="text/javascript" language="javascript">
		$( function() {
		    $( "#followup_date" ).datepicker({
		    	dateFormat: "yy-mm-dd"
			});
		});
	</script>
@endsection