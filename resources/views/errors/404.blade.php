@extends('layouts.master')

@section('title')
	404 Error
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="alert alert-danger">
				<strong>Error Message!</strong> {{ $exception->getMessage() }}.
			</div>
		</div>
		<div class="row">
			<p class="text-danger">Click the button to see the technical error (Required by the software developer):</p>
		</div>
		
		<div class="row">
			<button data-toggle="collapse" data-target="#demo">View Technical Error</button>
			
			<div id="demo" class="collapse">
			<pre>
			{{ $exception->getTraceAsString() }}
			</pre>
			</div>
		</div>
	</div>
@endsection
