<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">@yield('contact-list-title')</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-2 text-center">Firstname</th>
					<th class="col-sm-3 text-center">Surname</th>
					<th class="col-sm-2 text-center">Work Email</th>
					<th class="col-sm-2 text-center">Work Tel No</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTACT))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($contacts) && count($contacts) > 0)
					@foreach($contacts as $contact)
					<tr>
						<td>{{ $contact->id }}</td>
						<td>{{ $contact->firstname }}</td>
						<td>{{ $contact->surname }}</td>
						<td>{{ $contact->work_email }}</td>
						<td>{{ $contact->work_tel_no }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTACT))
							<td><a href="{{ route('update-contact', ['contact_id' => $contact->id, 'model_name' => $model_name, 'model_id' => $model_id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-contact', ['contact_id' => $contact->id, 'model_name' => $model_name, 'model_id' => $model_id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="7">No contacts</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>