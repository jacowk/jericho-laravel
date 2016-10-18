@extends('layouts.master')

@section('title')
	Search Notes
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-note', 'class' => 'form-horizontal')) }}
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
				<h4 class="panel-title">Notes Search Result</h4>
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
					@if (!empty($notes) && count($notes) > 0)
						@foreach($notes as $note)
						<tr>
							<td>{{ $note->id }}</td>
							<td>{{ $note->description }}</td>
							<td><a href="{{ route('update-note', ['note_id' => $note->id]) }}">Update</a></td>
							<td><a href="{{ route('view-note', ['note_id' => $note->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No notes</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'add-note')) }}
				{{ Form::token() }}
				{{ Form::submit('Add Note', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endsection
