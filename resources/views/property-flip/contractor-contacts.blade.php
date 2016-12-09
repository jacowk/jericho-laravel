<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Contractors</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-2 text-center">Contractor Name</th>
					<th class="col-sm-1 text-center">Firstname</th>
					<th class="col-sm-1 text-center">Surname</th>
					<th class="col-sm-1 text-center">Work Email</th>
					<th class="col-sm-2 text-center">Work Tel No</th>
					<th class="col-sm-1 text-center">Cell No</th>
					<th class="col-sm-2 text-center">Contractor Type</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::DELETE_CONTRACTOR_CONTACT_LINK))
						<th class="col-sm-1 text-center">Delete</th>
					@endif
					@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
						<th class="col-sm-1 text-center">View</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if (!empty($contractor_contacts) && count($contractor_contacts) > 0)
					@foreach($contractor_contacts as $contractor_contact)
					<tr>
						<td>{{ $contractor_contact->contractor_name }}</td>
						<td>{{ $contractor_contact->contact_firstname }}</td>
						<td>{{ $contractor_contact->contact_surname }}</td>
						<td>{{ $contractor_contact->contact_work_email }}</td>
						<td>{{ $contractor_contact->contact_work_tel_no }}</td>
						<td>{{ $contractor_contact->contact_cell_no }}</td>
						<td>{{ $contractor_contact->lookup_contractor_type }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::DELETE_CONTRACTOR_CONTACT_LINK))
							<td>
								<a href="javascript:deleteContactContractorConfirm({ property_flip_id:{{ $property_flip->id }}, contact_id:{{ $contractor_contact->contact_id }}, lookup_contractor_type_id:{{ $contractor_contact->lookup_contractor_type_id }} })">Delete</a>
							</td>
						@endif
						@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
							<td><a href="{{ route('view-contact', [ 'contact_id' => $contractor_contact->contact_id, 'model_name' => 'property_flip', 'model_id' => $property_flip->id ]) }}">View</a></td>
							<td>
								<button type="button" 
										class="btn btn-info btn-sm" 
										data-toggle="modal" 
										data-target="#contractorContactModal{{ $contractor_contact->contact_id }}">Contact Details</button>
								@include('property-flip.contractor-contact-modal')
							</td>
						@endif
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="9">No contractors</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::LINK_CONTRACTOR_CONTACT))
		<div class="row">
			{{  Form::open(['route' => 'link-contractor-contact', 'class' => 'form-horizontal']) }}
				{{  Form::token() }}
				{{  Form::hidden('property_flip_id', $property_flip->id) }}
				<div class="form-group">
					<div class="col-sm-10">
						{{ Form::submit('Link Contractor Contact', array('class' => 'btn btn-default')) }}
					</div>
				</div>
			{{  Form::close() }}
		</div>
	@endif
	<script type="text/javascript">
		function deleteContactContractorConfirm(params)
		{
			var path = "{{ route('do-link-contractor-contact-delete') }}";
			if (confirm("Are you sure you want to remove the contractor? (The contact will not be deleted)") == true)
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