@extends('layouts.master')

@section('title')
	Welcome
@endsection

@section('content')
<div class="container">
	@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_DIARY_ITEM))
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
	@else
		<div class="container">
			<div class="panel panel-default text-center">
				<div class="panel-heading">Welcome to Jericho</div>
				<div class="panel-body text-center">You are now logged in</div>
			</div>
		</div>
	@endif
</div>
@endsection
