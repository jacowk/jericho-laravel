@extends('layouts.master')

@section('title')
	Update Diary Item Comment
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-diary-item', $diary_item_comment->diary_item->id) }}">View Diary Item</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-diary-item-comment', $diary_item_comment->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $diary_item_comment->id }}</p>
				</div>
				{{ Form::label('comment', 'Comment', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::textarea('comment', $diary_item_comment->comment, array('class' => 'form-control', 'placeholder' => 'Comment')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Diary Item Comment', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection