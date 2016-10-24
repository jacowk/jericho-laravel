@extends('layouts.master')

@section('title')
	Reset Password
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-user') }}">Search User</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-reset-password', $user->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $user->id }}</p>
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('firstname', 'Firstname', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $user->firstname }}</p>
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('surname', 'Surname', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $user->surname }}</p>
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $user->email }}</p>
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('password', 'New Password', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::password('password', array('class' => 'form-control', 'placeholder' => 'New Password')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('password_confirm', 'Confirm Password' , array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Reset Password', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<script type="text/javascript">
		$( function() {
		    $('#email').inputmask({
				mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
				greedy: false,
				onBeforePaste: function (pastedValue, opts) {
					pastedValue = pastedValue.toLowerCase();
					return pastedValue.replace("mailto:", "");
				},
				definitions: {
					'*': {
						validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
						cardinality: 1,
						casing: "lower"
					}
				}
			});
		});
	</script>
@endsection