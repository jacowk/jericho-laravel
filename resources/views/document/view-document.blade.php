@extends('layouts.master')

@section('title')
	View Document
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $document->property_flip->id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $document->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Description</th>
					<td>{{ $document->description }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Generated Filename</th>
					<td>{{ $document->generated_filename }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">File Size</th>
					<td>{{ $document->file_size }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Original Name</th>
					<td>{{ $document->client_original_name }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Original Name</th>
					<td>{{ $document->client_original_name }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Original Extension</th>
					<td>{{ $document->client_original_extension }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Download File</th>
					<td><a href="{{ route('download-document-direct', $document->id) }}">Click to download</a></td>						
				</tr>
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => array('view-property-flip', $document->property_flip->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to View Property</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DOCUMENT))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-document', $document->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Update Document</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection