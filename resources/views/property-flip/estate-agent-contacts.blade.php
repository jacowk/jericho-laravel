<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Estate Agents</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-2 text-center">Estate Agent Name</th>
					<th class="col-sm-1 text-center">Firstname</th>
					<th class="col-sm-1 text-center">Surname</th>
					<th class="col-sm-1 text-center">Work Email</th>
					<th class="col-sm-2 text-center">Work Tel No</th>
					<th class="col-sm-1 text-center">Cell No</th>
					<th class="col-sm-2 text-center">Estate Agent Type</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::DELETE_ESTATE_AGENT_CONTACT_LINK))
						<th class="col-sm-1 text-center">Delete</th>
					@endif
					@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
						<th class="col-sm-1 text-center">View</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@if (!empty($estate_agent_contacts) && count($estate_agent_contacts) > 0)
					@foreach($estate_agent_contacts as $estate_agent_contact)
					<tr>
						<td>{{ $estate_agent_contact->estate_agent_name }}</td>
						<td>{{ $estate_agent_contact->contact_firstname }}</td>
						<td>{{ $estate_agent_contact->contact_surname }}</td>
						<td>{{ $estate_agent_contact->contact_work_email }}</td>
						<td>{{ $estate_agent_contact->contact_work_tel_no }}</td>
						<td>{{ $estate_agent_contact->contact_cell_no }}</td>
						<td>{{ $estate_agent_contact->lookup_estate_agent_type }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::DELETE_ESTATE_AGENT_CONTACT_LINK))
							<td>
								<a href="javascript:deleteContactEstateAgentConfirm({ property_flip_id:{{ $property_flip->id }}, contact_id:{{ $estate_agent_contact->contact_id }}, lookup_estate_agent_type_id:{{ $estate_agent_contact->lookup_estate_agent_type_id }} })">Delete</a>
							</td>
						@endif
						@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
							<td><a href="{{ route('view-contact', [ 'contact_id' => $estate_agent_contact->contact_id, 'model_name' => 'property_flip', 'model_id' => $property_flip->id ]) }}">View</a></td>
							<td>
								<button type="button" 
										class="btn btn-info btn-sm" 
										data-toggle="modal" 
										data-target="#estateAgentContactModal{{ $estate_agent_contact->contact_id }}">Contact Details</button>
								@include('property-flip.estate-agent-contact-modal')
							</td>
						@endif
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="9">No estate agents</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::LINK_ESTATE_AGENT_CONTACT))
		<div class="row">
			{{  Form::open(['route' => 'link-estate-agent-contact', 'class' => 'form-horizontal']) }}
				{{  Form::token() }}
				{{  Form::hidden('property_flip_id', $property_flip->id) }}
				<div class="form-group">
					<div class="col-sm-10">
						{{ Form::submit('Link Estate Agent Contact', array('class' => 'btn btn-default')) }}
					</div>
				</div>
			{{  Form::close() }}
		</div>
	@endif
	<script type="text/javascript">
		function deleteContactEstateAgentConfirm(params)
		{
			var path = "{{ route('do-link-estate-agent-contact-delete') }}";
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