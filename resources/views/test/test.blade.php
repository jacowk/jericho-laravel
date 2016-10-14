@extends('layouts.master')

@section('title')
	Test Page
@endsection

@section('breadcrumb')

@endsection

@section('content')
	<div class="container">
		<?php echo strtotime("yesterday midnight"); ?><br>
		<?php echo strtotime("today midnight"); ?><br>
	</div>
	
	
@endsection