@extends('layouts.master')

@section('title')
	Search Banks
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-bank', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('name', $name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
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
				<h4 class="panel-title">Banks Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_BANK))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($banks) && count($banks) > 0)
						@for($i = 0; $i < count($banks); $i++)
						<tr>
							<td>{{ $banks[$i]->id }}</td>
							<td>{{ $banks[$i]->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_BANK))
								<td><a href="{{ route('update-bank', ['bank_id' => $banks[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-bank', ['bank_id' => $banks[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
					@else
						<tr>
							<td colspan="4">No banks</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_BANK))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-bank')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Bank</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
