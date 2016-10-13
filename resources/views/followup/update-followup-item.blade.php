@extends('layouts.master')

@section('title')
	Update Followup Item
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-diary-item', $followup_item->diary_item->id) }}">View Diary Item</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-followup-item', $followup_item->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $followup_item->id }}</p>
				</div>
				{{ Form::label('comments', 'Comments', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::textarea('comments', $followup_item->comments, array('class' => 'form-control', 'placeholder' => 'Comments')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Update Followup Item</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection