<div class="container">
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
						{{ $property_flip->seller->firstname }} {{ $property_flip->seller->surname }}
					@endif
				</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Selling Price</th>
				<td>{{ $property_flip->selling_price }}</td>
			</tr>
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
			<tr>
				<th class="col-sm-3 text-right">Purchaser</th>
				<td>
					@if ($property_flip->purchaser)
						{{ $property_flip->purchaser->firstname }} {{ $property_flip->purchaser->surname }}
					@endif
				</td>						
			</tr>
			<tr>
				<th class="col-sm-3 text-right">Purchase Price</th>
				<td>{{ $property_flip->purchase_price }}</td>
			</tr>
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
		</table>
	</div>
	
	<div class="form-inline">
		<div class="form-group">
			{{  Form::open(['route' => ['view-property', $property_flip->property->id], 'class' => 'form-horizontal']) }}
				{{  Form::token() }}
				<div class="form-group">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-default">Back to View Property</button>
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
							<button type="submit" class="btn btn-default">Update Property Flip</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
		@endif
	</div>
</div>