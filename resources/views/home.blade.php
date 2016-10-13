@extends('layouts.master')

@section('title')
	Welcome
@endsection

@section('content')
<div class="container">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#today" aria-controls="today" role="tab" data-toggle="tab">Today's Diary Items</a></li>
		<li role="presentation"><a href="#open" aria-controls="open" role="tab" data-toggle="tab">Your Open Diary Items</a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="today">
			@include('diary.list-todays-diary-items')
		</div>
		
		<div role="tabpanel" class="tab-pane" id="open">
			@include('diary.list-open-diary-items')
		</div>
	</div>
</div>
@endsection
