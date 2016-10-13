<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Attorneys</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-2 text-center">Attorney Name</th>
					<th class="col-sm-1 text-center">Firstname</th>
					<th class="col-sm-1 text-center">Surname</th>
					<th class="col-sm-1 text-center">Work Email</th>
					<th class="col-sm-2 text-center">Work Tel No</th>
					<th class="col-sm-1 text-center">Cell No</th>
					<th class="col-sm-2 text-center">Attorney Type</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::DELETE_ATTORNEY_CONTACT_LINK))
						<th class="col-sm-1 text-center">Delete</th>
					@endif
					@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
						<th class="col-sm-1 text-center">View</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if (!empty($attorney_contacts) && count($attorney_contacts) > 0)
					@for($i = 0; $i < count($attorney_contacts); $i++)
					<tr>
						<td>{{ $attorney_contacts[$i]->attorney_name }}</td>
						<td>{{ $attorney_contacts[$i]->contact_firstname }}</td>
						<td>{{ $attorney_contacts[$i]->contact_surname }}</td>
						<td>{{ $attorney_contacts[$i]->contact_work_email }}</td>
						<td>{{ $attorney_contacts[$i]->contact_work_tel_no }}</td>
						<td>{{ $attorney_contacts[$i]->contact_cell_no }}</td>
						<td>{{ $attorney_contacts[$i]->lookup_attorney_type }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::DELETE_ATTORNEY_CONTACT_LINK))
							<td>
								<a href="javascript:deleteAttorneyContactConfirm({ property_flip_id:{{ $property_flip->id }}, contact_id:{{ $attorney_contacts[$i]->contact_id }}, lookup_attorney_type_id:{{ $attorney_contacts[$i]->lookup_attorney_type_id }} })">Delete</a>
							</td>
						@endif
						@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
							<td><a href="{{ route('view-contact', [ 'contact_id' => $attorney_contacts[$i]->contact_id, 'model_name' => 'property_flip', 'model_id' => $property_flip->id ]) }}">View</a></td>
						@endif
					</tr>
					@endfor
				@else
					<tr>
						<td colspan="9">No attorneys</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::LINK_ATTORNEY_CONTACT))
		<div class="row">
			{{  Form::open(['route' => 'link-attorney-contact', 'class' => 'form-horizontal']) }}
				{{  Form::token() }}
				{{  Form::hidden('property_flip_id', $property_flip->id) }}
				<div class="form-group">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-default">Link Attorney Contact</button>
					</div>
				</div>
			{{  Form::close() }}
		</div>
	@endif
	<script type="text/javascript">
		function deleteAttorneyContactConfirm(params)
		{
			var path = "{{ route('do-link-attorney-contact-delete') }}";
			if (confirm("Are you sure you want to remove the contact? (The contact will not be deleted)") == true)
			{
				var method = "post";
				/* Create the form */
				var form = document.createElement("form");
			    form.setAttribute("method", method);
			    form.setAttribute("action", path);

			    /* Add token */
				var hiddenField = document.createElement("input");
		        hiddenField.setAttribute("type", "hidden");
		        hiddenField.setAttribute("name", "_token");
		        hiddenField.setAttribute("value", "{{  Session::token() }}");
		        form.appendChild(hiddenField);

			    /* Property Flip Id hidden fields */
			    for (var key in params)
			    {
			    	if (params.hasOwnProperty(key))
				    {
			    		var hiddenField = document.createElement("input");
			            hiddenField.setAttribute("type", "hidden");
			            hiddenField.setAttribute("name", key);
			            hiddenField.setAttribute("value", params[key]);
			            form.appendChild(hiddenField);
				    }
				}

				/* Append form to document and submit */
			    document.body.appendChild(form);
			    form.submit();
		    }
			else
			{
		        //Do nothing if cancel is pressed
			}
		}
	</script>
</div>