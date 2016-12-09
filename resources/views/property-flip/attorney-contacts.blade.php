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
					@foreach($attorney_contacts as $attorney_contact)
					<tr>
						<td>{{ $attorney_contact->attorney_name }}</td>
						<td>{{ $attorney_contact->contact_firstname }}</td>
						<td>{{ $attorney_contact->contact_surname }}</td>
						<td>{{ $attorney_contact->contact_work_email }}</td>
						<td>{{ $attorney_contact->contact_work_tel_no }}</td>
						<td>{{ $attorney_contact->contact_cell_no }}</td>
						<td>{{ $attorney_contact->lookup_attorney_type }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::DELETE_ATTORNEY_CONTACT_LINK))
							<td>
								<a href="javascript:deleteAttorneyContactConfirm({ property_flip_id:{{ $property_flip->id }}, contact_id:{{ $attorney_contact->contact_id }}, lookup_attorney_type_id:{{ $attorney_contact->lookup_attorney_type_id }} })">Delete</a>
							</td>
						@endif
						@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
							<td><a href="{{ route('view-contact', [ 'contact_id' => $attorney_contact->contact_id, 'model_name' => 'property_flip', 'model_id' => $property_flip->id ]) }}">View</a></td>
							<td>
								<button type="button" 
										class="btn btn-info btn-sm" 
										data-toggle="modal" 
										data-target="#attorneyContactModal{{ $attorney_contact->contact_id }}">Contact Details</button>
								@include('property-flip.attorney-contact-modal')
							</td>
						@endif
					</tr>
					@endforeach
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
						{{ Form::submit('Link Attorney Contact', array('class' => 'btn btn-default')) }}
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

<!-- Contact Modal -->
<div id="contactModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Seller Contact Details</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<th class="col-sm-2 text-right">ID</th>
						<td>{{ $property_flip->seller->id }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Title</th>
						<td>
							@if ($property_flip->seller->title)
								{{ $property_flip->seller->title->description }}
							@endif
						</td>
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Firstname</th>
						<td>{{ $property_flip->seller->firstname }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Surname</th>
						<td>{{ $property_flip->seller->surname }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Home Tel No</th>
						<td>{{ $property_flip->seller->home_tel_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Work Tel No</th>
						<td>{{ $property_flip->seller->work_tel_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Cell No</th>
						<td>{{ $property_flip->seller->cell_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Fax No</th>
						<td>{{ $property_flip->seller->fax_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Personal Email</th>
						<td>{{ $property_flip->seller->personal_email }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Work Email</th>
						<td>{{ $property_flip->seller->work_email }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">ID Number</th>
						<td>{{ $property_flip->seller->id_number }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Passport Number</th>
						<td>{{ $property_flip->seller->passport_number }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Marital Status</th>
						<td>
							@if ($property_flip->seller->marital_status)
								{{ $property_flip->seller->marital_status->description }}
							@endif
						</td>
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Tax Number</th>
						<td>{{ $property_flip->seller->tax_number }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">SA Citizen</th>
						<td>
							@if ($property_flip->seller->sa_citizen === 1)
								{{ "Yes" }}
							@else
								{{ "No" }}
							@endif
						</td>						
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>