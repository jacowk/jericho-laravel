@if ($property)
	<div class="container">
		<div class="row">
			<div class="panel-heading text-center">
				<h4 class="panel-property-type">Property Details</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $property->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Address</th>
					<td>
						{{ $property->address_line_1 }}<br>
						@if ($property->address_line_2)
							{{ $property->address_line_2 }}<br>
						@endif
						@if ($property->address_line_3)
							{{ $property->address_line_3 }}<br>
						@endif
						@if ($property->address_line_4)
							{{ $property->address_line_4 }}<br>
						@endif
						@if ($property->address_line_5)
							{{ $property->address_line_5 }}<br>
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Suburb</th>
					<td>
						@if ($property->suburb)
							{{ $property->suburb->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Area</th>
					<td>
						@if ($property->area)
							{{ $property->area->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Greater Area</th>
					<td>
						@if ($property->greater_area)
							{{ $property->greater_area->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Property Type</th>
					<td>
						@if ($property->lookup_property_type)
							{{ $property->lookup_property_type->description }}
						@endif
					</td>
				</tr>
			</table>
		</div>
	</div>
@endif

<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-property-type">Property Flip Details</h4>
		</div>
	</div>
	<div class="form-group">
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<th class="col-sm-3 text-right">ID</th>
				<td>{{ $property_flip->id }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Reference Number</th>
				<td>{{ $property_flip->reference_number }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Title Deed Number</th>
				<td>{{ $property_flip->title_deed_number }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Case Number</th>
				<td>{{ $property_flip->case_number }}</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Seller</th>
				<td>
					@if ($property_flip->seller)
						{{ $property_flip->seller->firstname }} {{ $property_flip->seller->surname }} &nbsp;
						@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#sellerModal">Contact Details</button>
						@endif
					@endif
				</td>						
			</tr>
			@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_SELLING_PRICE))
				<tr>
					<th class="col-sm-3 text-right">Selling Price</th>
					<td>{{ MoneyUtil::toRandsAndFormat($property_flip->selling_price) }}</td>
				</tr>
			@endif
			@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_SELLER_STATUS))
				<tr>
					<th class="col-sm-3 text-right">Seller Status</th>
					<td>
						@if ($property_flip->seller_status)
							{{ $property_flip->seller_status->description }}
						@else
							No seller status
						@endif
					</td>
				</tr>
			@endif
			<tr>
				<th class="col-sm-3 text-right">Purchaser</th>
				<td>
					@if ($property_flip->purchaser)
						{{ $property_flip->purchaser->firstname }} {{ $property_flip->purchaser->surname }} &nbsp;
						@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
							<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#purchaserModal">Contact Details</button>
						@endif
					@endif
				</td>						
			</tr>
			@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PURCHASE_PRICE))
				<tr>
					<th class="col-sm-3 text-right">Purchase Price</th>
					<td>{{ MoneyUtil::toRandsAndFormat($property_flip->purchase_price) }}</td>
				</tr>
			@endif
			@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_FINANCE_STATUS))
				<tr>
					<th class="col-sm-3 text-right">Finance Status</th>
					<td>
						@if ($property_flip->finance_status)
							{{ $property_flip->finance_status->description }}
						@else
							No finance status
						@endif
					</td>
				</tr>
			@endif
			@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_STATUS))
				<tr>
					<th class="col-sm-3 text-right">Property Status</th>
					<td>
						@if ($property_flip->property_status)
							{{ $property_flip->property_status->description }}
						@else
							No property status
						@endif
					</td>
				</tr>
			@endif
			@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
				<tr>
					<th class="col-sm-3 text-right">Created By</th>
					<td>
						@if ($property_flip->created_by)
							{{ $property_flip->created_by->firstname }} {{ $property_flip->created_by->surname }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Created At</th>
					<td>{{ $property_flip->created_at }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Updated By</th>
					<td>
						@if ($property_flip->updated_by)
							{{ $property_flip->updated_by->firstname }} {{ $property_flip->updated_by->surname }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Updated At</th>
					<td>{{ $property_flip->updated_at }}</td>						
				</tr>
			@endif
		</table>
	</div>
	
	<div class="form-inline">
		<div class="form-group">
			{{  Form::open(['route' => ['view-property', $property_flip->property->id], 'class' => 'form-horizontal']) }}
				{{  Form::token() }}
				<div class="form-group">
					<div class="col-sm-10">
						{{ Form::submit('Back to View Property', array('class' => 'btn btn-default')) }}
					</div>
				</div>
			{{  Form::close() }}
		</div>
		@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY_FLIP))
			<div class="form-group">
				{{  Form::open(array('route' => array('update-property-flip', $property_flip->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Update Property Flip', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
		@endif
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_REPORT))
			<div class="form-group">
				{{  Form::open(array('route' => array('download-property-flip-report-pdf', $property_flip->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Download Property Flip Report', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
		@endif
	</div>
</div>

<!-- Seller Modal -->
<div id="sellerModal" class="modal fade" role="dialog">
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

<!-- Purchaser Modal -->
<div id="purchaserModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Purchaser Contact Details</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-striped table-condensed">
					<tr>
						<th class="col-sm-2 text-right">ID</th>
						<td>{{ $property_flip->purchaser->id }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Title</th>
						<td>
							@if ($property_flip->purchaser->title)
								{{ $property_flip->purchaser->title->description }}
							@endif
						</td>
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Firstname</th>
						<td>{{ $property_flip->purchaser->firstname }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Surname</th>
						<td>{{ $property_flip->purchaser->surname }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Home Tel No</th>
						<td>{{ $property_flip->purchaser->home_tel_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Work Tel No</th>
						<td>{{ $property_flip->purchaser->work_tel_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Cell No</th>
						<td>{{ $property_flip->purchaser->cell_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Fax No</th>
						<td>{{ $property_flip->purchaser->fax_no }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Personal Email</th>
						<td>{{ $property_flip->purchaser->personal_email }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Work Email</th>
						<td>{{ $property_flip->purchaser->work_email }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">ID Number</th>
						<td>{{ $property_flip->purchaser->id_number }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Passport Number</th>
						<td>{{ $property_flip->purchaser->passport_number }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Marital Status</th>
						<td>
							@if ($property_flip->purchaser->marital_status)
								{{ $property_flip->purchaser->marital_status->description }}
							@endif
						</td>
					</tr>
					<tr>
						<th class="col-sm-2 text-right">Tax Number</th>
						<td>{{ $property_flip->purchaser->tax_number }}</td>						
					</tr>
					<tr>
						<th class="col-sm-2 text-right">SA Citizen</th>
						<td>
							@if ($property_flip->purchaser->sa_citizen === 1)
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