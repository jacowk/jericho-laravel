<div id="contractorContactModal{{ $contractor_contact->contact_id }}" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Contractor Contact Details</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<th class="col-sm-2 text-right">ID</th>
						<td>{{ $contractor_contact->contact_id }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Title</th>
						<td>{{ $contractor_contact->contact_title }}</td>
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Firstname</th>
						<td>{{ $contractor_contact->contact_firstname }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Surname</th>
						<td>{{ $contractor_contact->contact_surname }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Home Tel No</th>
						<td>{{ $contractor_contact->contact_home_tel_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Work Tel No</th>
						<td>{{ $contractor_contact->contact_work_tel_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Cell No</th>
						<td>{{ $contractor_contact->contact_cell_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Fax No</th>
						<td>{{ $contractor_contact->contact_fax_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Personal Email</th>
						<td>{{ $contractor_contact->contact_personal_email }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Work Email</th>
						<td>{{ $contractor_contact->contact_work_email }}</td>						
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>