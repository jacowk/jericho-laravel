@extends('layouts.master')

@section('title')
	Search Milestones
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-milestone', 'class' => 'form-horizontal')) }}
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
				<h4 class="panel-title">Milestones Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-5 text-center">Milestone Type</th>
						<th class="col-sm-4 text-center">Effective Date</th>
						<th class="col-sm-1 text-center">Edit</th>
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($milestones) && count($milestones) > 0)
						@foreach($milestones as $milestone)
						<tr>
							<td>{{ $milestone->id }}</td>
							<td>{{ $milestone->lookup_milestone_type->description }}</td>
							<td>{{ $milestone->effective_date }}</td>
							<td><a href="{{ route('update-milestone', ['milestone_id' => $milestone->id]) }}">Update</a></td>
							<td><a href="{{ route('view-milestone', ['milestone_id' => $milestone->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No milestones</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'add-milestone')) }}
				{{ Form::token() }}
				{{ Form::submit('Add Milestone', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endsection
