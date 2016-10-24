@extends('layouts.master')

@section('title')
	Add User
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-user') }}">Search User</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-user', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			
			<div class="form-group">
				{{  Form::label('firstname', 'Firstname', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('firstname', '', array('class' => 'form-control captialize', 'placeholder' => 'Firstname')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('surname', 'Surname', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('surname', '', array('class' => 'form-control captialize', 'placeholder' => 'Surname')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('password_confirm', 'Confirm Password' , array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::password('password_confirm', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('pagination_size', 'Results Per Page', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('pagination_size', $pagination_options, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('roles', 'Roles', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($roles)
						@foreach($roles as $id => $name)
							{{ Form::checkbox($name['html_name'], $id, null, ['class' => 'field']) }} {{ $name['name'] }}<br>
						@endforeach
					@endif
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add User', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
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