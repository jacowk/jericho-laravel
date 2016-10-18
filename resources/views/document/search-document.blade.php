@extends('layouts.master')

@section('title')
	Search Documents
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-document', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10"> 
						{{ Form::submit('Search', array('class' => 'btn btn-default')) }}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div><br/>
	<div class="container">
		<div class="row">
			<div class="panel-heading">
				<h4 class="panel-title">Documents Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						<th class="col-sm-1 text-center">Edit</th>
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($documents) && count($documents) > 0)
						@foreach($documents as $document)
						<tr>
							<td>{{ $document->id }}</td>
							<td>{{ $document->description }}</td>
							<td><a href="{{ route('update-document', ['document_id' => $document->id]) }}">Update</a></td>
							<td><a href="{{ route('view-document', ['document_id' => $document->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No documents</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'add-document')) }}
				{{ Form::token() }}
				{{ Form::submit('Add Document', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endsection
