@extends('layouts.master')

@section('title')
	Update Issue Comment
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-issue', $issue_comment->issue->id) }}">View Issue</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-issue-comment', $issue_comment->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $issue_comment->id }}</p>
				</div>
				
				{{ Form::label('comment', 'Comment', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::textarea('comment', $issue_comment->comment, array('class' => 'form-control', 'placeholder' => 'Comment')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Issue Comment', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection