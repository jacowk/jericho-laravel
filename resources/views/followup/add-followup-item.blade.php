@extends('layouts.master')

@section('title')
	Add Followup Item
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-diary-item', $diary_item_id) }}">View Diary Item</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-followup-item', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('diary_item_id', $diary_item_id) }}
			
			<div class="form-group">
				{{  Form::label('comments', 'Comments', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::textarea('comments', '', array('class' => 'form-control', 'placeholder' => 'Comments')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Add Followup Item</button>
				</div>
			</div>
		{{  Form::close() }}
	</div>
@endsection