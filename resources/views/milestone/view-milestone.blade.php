@extends('layouts.master')

@section('title')
	View Milestone
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $milestone->property_flip->id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $milestone->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Milestone Type</th>
					<td>{{ $milestone->lookup_milestone_type->description }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Effective Date</th>
					<td>{{ $milestone->effective_date }}</td>						
				</tr>
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => array('view-property-flip', $milestone->property_flip->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to View Property</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MILESTONE))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-milestone', $milestone->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Update Milestone</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection