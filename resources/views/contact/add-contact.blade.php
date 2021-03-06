@extends('layouts.master')

@section('title')
	Add Contact
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active">
		@if ($model_view_route === 'search-contact')
			<a href="{{ route($model_view_route) }}">{{ $link_description }}</a>
		@else
			<a href="{{ route($model_view_route, array($model_id_name => $model_id)) }}">{{ $link_description }}</a>
		@endif
	</li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-contact', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('model_name', $model_name) }}
			{{  Form::hidden('model_id', $model_id) }}
			<div class="form-group">
				{{  Form::label('title_id', 'Title', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('title_id', $lookup_titles, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
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
				{{  Form::label('home_tel_no', 'Home Tel No', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('home_tel_no', '', array('class' => 'form-control', 'placeholder' => 'Home Telephone Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('work_tel_no', 'Work Tel No', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('work_tel_no', '', array('class' => 'form-control', 'placeholder' => 'Work Telephone Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('cell_no', 'Cell No', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('cell_no', '', array('class' => 'form-control', 'placeholder' => 'Cell Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('fax_no', 'Fax No', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('fax_no', '', array('class' => 'form-control', 'placeholder' => 'Fax Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('personal_email', 'Personal Email', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('personal_email', '', array('class' => 'form-control', 'placeholder' => 'Personal Email')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('work_email', 'Work Email', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('work_email', '', array('class' => 'form-control', 'placeholder' => 'Work Email')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('id_number', 'ID Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('id_number', '', array('class' => 'form-control', 'placeholder' => 'ID Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('passport_number', 'Passport Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('passport_number', '', array('class' => 'form-control', 'placeholder' => 'Passport Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('marital_status_id', 'Marital Status', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('marital_status_id', $lookup_marital_statuses, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('tax_number', 'Tax Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('tax_number', '', array('class' => 'form-control', 'placeholder' => 'Tax Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('sa_citizen', 'SA Citizen', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::radio('sa_citizen', '1', true) }} Yes 
					{{  Form::radio('sa_citizen', '0') }} No 
					<!-- <label class="radio-inline"><input type="radio" id="sa_citizen" name="sa_citizen" value="1">Yes</label>
					<label class="radio-inline"><input type="radio" id="sa_citizen" name="sa_citizen" value="0">No</label> -->
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add Contact', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
	
	<script type="text/javascript">
		$( function() {
		    $('#home_tel_no').inputmask('999 999 9999', {
				numericInput: true
			});
			
		    $('#work_tel_no').inputmask('999 999 9999', {
				numericInput: true
			});
			
		    $('#cell_no').inputmask('999 999 9999', {
				numericInput: true
			});
			
		    $('#fax_no').inputmask('999 999 9999', {
				numericInput: true
			});
			
		    $('#personal_email').inputmask({
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

		    $('#work_email').inputmask({
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