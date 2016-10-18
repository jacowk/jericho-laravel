<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Documents</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-3 text-center">Document Type</th>
					<th class="col-sm-4 text-center">Description</th>
					<th class="col-sm-2 text-center">Date Created</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DOCUMENT))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($property_flip->documents) && count($property_flip->documents) > 0)
					@foreach($property_flip->documents as $document)
					<tr>
						<td>{{ $document->id }}</td>
						<td>
							@if ($document->document_type)
								{{ $document->document_type->description }}
							@endif
						</td>
						<td>{{ $document->description }}</td>
						<td>{{ $document->created_at }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DOCUMENT))
							<td><a href="{{ route('update-document', ['document_id' => $document->id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-document', ['document_id' => $document->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="5">No documents</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@if (PermissionValidator::hasPermission(PermissionConstants::ADD_DOCUMENT))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-document', $property_flip->id))) }}
				{{ Form::token() }}
				<button type="submit" class="btn btn-default">Add Document</button>
			{{ Form::close() }}
		</div>
	</div>
@endif