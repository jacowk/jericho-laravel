@extends('layouts.master')

@section('title')
	Update Contact
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-contact') }}">Search Contact</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-contact', $contact->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			{{  Form::hidden('model_name', $model_name) }}
			{{  Form::hidden('model_id', $model_id) }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ $contact->id }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('title_id', 'Title', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('title_id', $lookup_titles, $contact->title_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('firstname', 'Firstname', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('firstname', $contact->firstname, array('class' => 'form-control', 'placeholder' => 'Firstname')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('surname', 'Surname', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('surname', $contact->surname, array('class' => 'form-control', 'placeholder' => 'Surname')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('home_tel_no', 'Home Tel No', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('home_tel_no', $contact->home_tel_no, array('class' => 'form-control', 'placeholder' => 'Home Telephone Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('work_tel_no', 'Work Tel No', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('work_tel_no', $contact->work_tel_no, array('class' => 'form-control', 'placeholder' => 'Work Telephone Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('cell_no', 'Cell No', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('cell_no', $contact->cell_no, array('class' => 'form-control', 'placeholder' => 'Cell No')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('fax_no', 'Fax No', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('fax_no', $contact->fax_no, array('class' => 'form-control', 'placeholder' => 'Fax No')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('personal_email', 'Personal Email', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('personal_email', $contact->personal_email, array('class' => 'form-control', 'placeholder' => 'Personal Email')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('work_email', 'Work Email', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('work_email', $contact->work_email, array('class' => 'form-control', 'placeholder' => 'Work Email')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('id_number', 'ID Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('id_number', $contact->id_number, array('class' => 'form-control', 'placeholder' => 'ID Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('passport_number', 'Passport Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('passport_number', $contact->passport_number, array('class' => 'form-control', 'placeholder' => 'Passport Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('marital_status_id', 'Marital Status', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::select('marital_status_id', $lookup_marital_statuses, $contact->marital_status_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('tax_number', 'Tax Number', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('tax_number', $contact->tax_number, array('class' => 'form-control', 'placeholder' => 'Tax Number')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{ Form::label('sa_citizen', 'SA Citizen', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($contact->sa_citizen === 1)
						{{ Form::radio('sa_citizen', '1', true) }}Yes
						{{ Form::radio('sa_citizen', '0') }}No
					
						<!-- <label class="radio-inline">
							<input type="radio" 
									id="sa_citizen" 
									name="sa_citizen" 
									value="1" 
									checked="checked">Yes
						</label>
						<label class="radio-inline">
							<input type="radio" 
									id="sa_citizen" 
									name="sa_citizen" 
									value="0">No
						</label> -->
					@elseif ($contact->sa_citizen === 0)
						{{ Form::radio('sa_citizen', '1') }}Yes
						{{ Form::radio('sa_citizen', '0', true) }}No
						
						<!-- <label class="radio-inline">
							<input type="radio" 
									id="sa_citizen" 
									name="sa_citizen" 
									value="1">Yes
						</label>
						<label class="radio-inline">
							<input type="radio" 
									id="sa_citizen" 
									name="sa_citizen" 
									value="0"
									checked="checked">No
						</label> -->
					@else
						{{ Form::radio('sa_citizen', '1') }}Yes
						{{ Form::radio('sa_citizen', '0') }}No
						
						<!-- <label class="radio-inline">
							<input type="radio" 
									id="sa_citizen" 
									name="sa_citizen" 
									value="1">Yes
						</label>
						<label class="radio-inline">
							<input type="radio" 
									id="sa_citizen" 
									name="sa_citizen" 
									value="0">No
						</label> -->
					@endif	
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Update Contact</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection