@extends('layouts.master')

@section('title')
	Add Document
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $property_flip_id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-document', 'class' => 'form-horizontal', 'files' => true)) }}
			{{  Form::token() }}
			{{  Form::hidden('property_flip_id', $property_flip_id) }}
			
			<div class="form-group">
				{{  Form::label('document_type_id', 'Document Service Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('document_type_id', $document_types, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('description', '', array('class' => 'form-control', 'placeholder' => 'Description')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('uploaded_file', 'Upload File', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::file('uploaded_file', '', array('class' => 'form-control', 'placeholder' => 'Upload File')) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add Document', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
@endsection