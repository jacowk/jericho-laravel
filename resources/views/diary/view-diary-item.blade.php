@extends('layouts.master')

@section('title')
	View Diary Item
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property-flip', $diary_item->property_flip->id) }}">View Property Flip</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<th class="col-sm-2 text-right">ID</th>
				<td>{{ $diary_item->id }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Followup Date</th>
				<td>{{ $diary_item->followup_date }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Followup User</th>
				<td>{{ $diary_item->followup_user->firstname }} {{ $diary_item->followup_user->surname }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Comments</th>
				<td>{{ $diary_item->comments }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Status</th>
				<td>{{ $diary_item->status->description }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Allocated User</th>
				<td>
					@if ($diary_item->allocated_user)
						{{ $diary_item->allocated_user->firstname }} {{ $diary_item->allocated_user->surname  }}
					@endif
				</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Created By</th>
				<td>{{ $diary_item->created_by_id }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Created At</th>
				<td>{{ $diary_item->created_at }}</td>						
			</tr>
		</table>
		<div class="row">
			<div class="form-inline">
				<div class="form-group">
					{{  Form::open(array('route' => array('view-property-flip', $diary_item->property_flip->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<button type="submit" class="btn btn-default">Back to View Property</button>
					{{  Form::close() }}
				</div>
				
				@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DIARY_ITEM))
					<div class="form-group">
						{{  Form::open(array('route' => array('update-diary-item', $diary_item->id), 'class' => 'form-horizontal')) }}
							{{  Form::token() }}
							<button type="submit" class="btn btn-default">Update Diary Item</button>
						{{  Form::close() }}
					</div>
				@endif
				
				@if (PermissionValidator::hasPermission(PermissionConstants::SELF_ALLOCATE_DIARY_ITEM))
					<div class="form-group">
						{{ Form::open(array('route' => array('self-allocate-diary-item', $diary_item->id), 'class' => 'form-horizontal')) }}
							{{ Form::token() }}
							<button type="submit" class="btn btn-default">Self Allocate</button>
						{{ Form::close() }}
					</div>
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_FOLLOWUP_ITEM))
		@include('followup.list-followup-items')
	@endif
@endsection