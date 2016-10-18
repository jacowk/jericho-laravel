@extends('layouts.master')

@section('title')
	Update Document
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $document->property_flip->id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-document', $document->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			
			<div class="form-group">
				{{  Form::label('document_type_id', 'Document Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('document_type_id', $document_types, $document->document_type_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('description', $document->description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
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
					<button type="submit" class="btn btn-default">Update Document</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection