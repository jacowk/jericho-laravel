<div class="container">
	<div class="form-group">
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<th class="col-sm-3 text-right">ID</th>
				<td>{{ $property_flip->milestone->id }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Date Offer Made</th>
				<td>{{ $property_flip->milestone->date_offer_made }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Date Of Acceptance</th>
				<td>{{ $property_flip->milestone->date_of_acceptance }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Date Of Seller Signature</th>
				<td>{{ $property_flip->milestone->date_of_seller_signature }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Date Of Purchaser Signature</th>
				<td>{{ $property_flip->milestone->date_of_purchaser_signature }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Renovation Start Date</th>
				<td>{{ $property_flip->milestone->renovation_start_date }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Renovation End Date</th>
				<td>{{ $property_flip->milestone->renovation_end_date }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">For Sale Date</th>
				<td>{{ $property_flip->milestone->for_sale_date }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Sell Date</th>
				<td>{{ $property_flip->milestone->sell_date }}</td>
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Finance Status</th>
				<td>
					@if ($property_flip->milestone->status)
						$property_flip->milestone->status->description
					@else
						No status
					@endif
				</td>
			</tr>
		</table>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MILESTONE))
		{{  Form::open(array('route' => array('update-milestone', $property_flip->milestone->id), 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			<div class="form-group">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-default">Update Milestones</button>
				</div>
			</div>
		{{  Form::close() }}
	@endif
</div>