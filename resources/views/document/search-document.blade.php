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
						<button type="submit" class="btn btn-default">Search</button>
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
						@for($i = 0; $i < count($documents); $i++)
						<tr>
							<td>{{ $documents[$i]->id }}</td>
							<td>{{ $documents[$i]->description }}</td>
							<td><a href="{{ route('update-document', ['document_id' => $documents[$i]->id]) }}">Update</a></td>
							<td><a href="{{ route('view-document', ['document_id' => $documents[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
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
				<button type="submit" class="btn btn-default">Add Document</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection
