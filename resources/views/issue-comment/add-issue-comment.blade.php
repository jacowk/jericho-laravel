@extends('layouts.master')

@section('title')
	Add Issue Comment
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-issue', $issue_id) }}">View Issue</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-issue-comment', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('issue_id', $issue_id) }}
			
			<div class="form-group">
				{{  Form::label('comment', 'Comment', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::textarea('comment', '', array('class' => 'form-control', 'placeholder' => 'Comment')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add Issue Comment', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
@endsection