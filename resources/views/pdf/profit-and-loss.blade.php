@extends('layouts.pdf-master')

@section('title')
	Profit And Loss Report
@endsection

@section('content')
	<div class="page">
		<div>
			<div class="main-heading">Profit And Loss Report</div>
			<div class="main-sub-heading">{{ $from_date }} to {{ $to_date }}</div><br/>
		</div>
		<div class="row">
			
		</div>
	</div>
@endsection
