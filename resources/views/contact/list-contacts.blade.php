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
					@for($i = 0; $i < count($contacts); $i++)
					<tr>
						<td>{{ $contacts[$i]->id }}</td>
						<td>{{ $contacts[$i]->firstname }}</td>
						<td>{{ $contacts[$i]->surname }}</td>
						<td>{{ $contacts[$i]->work_email }}</td>
						<td>{{ $contacts[$i]->work_tel_no }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTACT))
							<td><a href="{{ route('update-contact', ['contact_id' => $contacts[$i]->id, 'model_name' => $model_name, 'model_id' => $model_id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-contact', ['contact_id' => $contacts[$i]->id, 'model_name' => $model_name, 'model_id' => $model_id]) }}">View</a></td>
					</tr>
					@endfor
				@else
					<tr>
						<td colspan="7">No contacts</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>