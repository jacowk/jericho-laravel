@extends('layouts.master')

@section('title')
	Update Profile
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-profile') }}">View Profile</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-profile', $user->id), 'class' => 'form-horizontal')) }}
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
					{{  Form::text('firstname', $user->firstname, array('class' => 'form-control captialize', 'placeholder' => 'Firstname')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('surname', 'Surname', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('surname', $user->surname, array('class' => 'form-control captialize', 'placeholder' => 'Surname')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('email', $user->email, array('class' => 'form-control', 'placeholder' => 'Email')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('results_per_page', 'Results Per Page', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('results_per_page', $pagination_size_options, $user->pagination_size, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Profile', array('class' => 'btn btn-default')) }}
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