@extends('layouts.master')

@section('title')
	View Diary Item Comment
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-diary-item', $diary_item_comment->diary_item->id) }}">View Diary Item</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $diary_item_comment->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Comment</th>
					<td>{{ $diary_item_comment->comment }}</td>						
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($diary_item_comment->created_by)
								{{ $diary_item_comment->created_by->firstname }} {{ $diary_item_comment->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $diary_item_comment->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($diary_item_comment->updated_by)
								{{ $diary_item_comment->updated_by->firstname }} {{ $diary_item_comment->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $diary_item_comment->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => array('view-diary-item', $diary_item_comment->diary_item->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Back to Diary Item', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DIARY_ITEM_COMMENT))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-diary-item-comment', $diary_item_comment->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Update Diary Item Comment', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection