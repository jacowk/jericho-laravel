@extends('layouts.master')

@section('title')
	View Milestone Type
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-milestone-type') }}">Search Milestone Type</a></li>
</ol>
@endsection

@section('content')s
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $milestone_type->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Description</th>
					<td>{{ $milestone_type->description }}</td>						
				</tr>
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-milestone-type', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to Search Milestone Types</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MILESTONE_TYPE))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-milestone-type', $milestone_type->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Update Milestone Type</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection