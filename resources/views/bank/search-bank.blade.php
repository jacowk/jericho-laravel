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
						{{ Form::submit('Search', array('class' => 'btn btn-default')) }}
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
						@foreach($banks as $bank)
						<tr>
							<td>{{ $bank->id }}</td>
							<td>{{ $bank->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_BANK))
								<td><a href="{{ route('update-bank', ['bank_id' => $bank->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-bank', ['bank_id' => $bank->id]) }}">View</a></td>
						</tr>
						@endforeach
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
					{{ Form::submit('Add Bank', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
