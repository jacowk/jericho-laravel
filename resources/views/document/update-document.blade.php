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
					@if ($document->document_type)
						{{ Form::select('document_type_id', $document_types, $document->document_type->id, ['class' => 'form-control']) }}
					@else
						{{ Form::select('document_type_id', $document_types, '', ['class' => 'form-control']) }}
					@endif
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
					{{ Form::submit('Update Document', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection