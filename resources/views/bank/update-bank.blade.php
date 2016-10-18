@extends('layouts.master')

@section('title')
	Update Bank
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-bank') }}">Search Bank</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-bank', $bank->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $bank->id }}</p>
				</div>
				{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('name', $bank->name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Bank', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection