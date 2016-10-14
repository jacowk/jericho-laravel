@extends('layouts.master')

@section('title')
	Update Diary Item
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $diary_item->property_flip->id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => array('do-update-diary-item', $diary_item->id), 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			
			<div class="form-group">
				{{  Form::label('followup_date', 'Followup Date', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('followup_date', $diary_item->followup_date, array('class' => 'form-control', 'placeholder' => 'Followup Date')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('followup_user_id', 'Followup User', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('followup_user_id', $lookup_users, $diary_item->followup_user_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('comments', 'Comments', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::textarea('comments', $diary_item->comments, array('class' => 'form-control', 'placeholder' => 'Comment')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('status_id', 'Status', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('status_id', $diary_item_statuses, $diary_item->status_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Update Diary Item</button>
				</div>
			</div>
		{{  Form::close() }}
	</div>
	<script type="text/javascript">
		$( function() {
// 		    $( "#followup_date" ).datepicker({
// 		    	dateFormat: "yy-mm-dd"
// 			});

			$('#followup_date').datetimepicker({
				formatTime:'H:i',
				formatDate:'Y-m-d',
				step:5
			});
		});
	</script>
@endsection