@extends('layouts.master')

@section('title')
	Search Titles
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-title', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('description', $description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
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
				<h4 class="panel-title">Titles Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TITLE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($titles) && count($titles) > 0)
						@for($i = 0; $i < count($titles); $i++)
						<tr>
							<td>{{ $titles[$i]->id }}</td>
							<td>{{ $titles[$i]->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TITLE))
								<td><a href="{{ route('update-title', ['title_id' => $titles[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-title', ['title_id' => $titles[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
					@else
						<tr>
							<td colspan="4">No titles</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_TITLE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-title')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Title</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
