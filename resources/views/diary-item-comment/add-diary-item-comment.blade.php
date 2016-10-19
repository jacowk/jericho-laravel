@extends('layouts.master')

@section('title')
	Add Diary Item Comment
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-diary-item', $diary_item_id) }}">View Diary Item</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-diary-item-comment', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('diary_item_id', $diary_item_id) }}
			
			<div class="form-group">
				{{  Form::label('comment', 'Comment', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::textarea('comment', '', array('class' => 'form-control', 'placeholder' => 'Comment')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add Diary Item Comment', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
@endsection