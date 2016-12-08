@extends('layouts.pdf-master')

@section('title')
	Property Flip Report
@endsection

@section('content')
	<div class="page">
		<div>
			<div class="main-heading">Property Report</div>
			<div class="main-sub-heading">Reference Number {{ $property_flip->reference_number }}</div><br/>
		</div>
		
		<!-- Property Details -->
		<div>
			<div class="main-sub-heading">Property Details</div>
		</div>
		<div>
			<table>
				<tr>
					<th>ID</th>
					<td>{{ $property->id }}</td>
				</tr>
				<tr>
					<th>Address</th>
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
					<th>Suburb</th>
					<td>
						@if ($property->suburb)
							{{ $property->suburb->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th>Area</th>
					<td>
						@if ($property->area)
							{{ $property->area->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th>Greater Area</th>
					<td>
						@if ($property->greater_area)
							{{ $property->greater_area->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th>Property Type</th>
					<td>
						@if ($property->lookup_property_type)
							{{ $property->lookup_property_type->description }}
						@endif
					</td>
				</tr>
			</table>
		</div>
		
		
		<!-- Property Flip Details -->
		<div>
			<div class="main-sub-heading">Property Flip Details</div>
		</div>
		<div>
			<table>
				<tr>
					<th>ID</th>
					<td>{{ $property_flip->id }}</td>						
				</tr>
				<tr>
					<th>Reference Number</th>
					<td>{{ $property_flip->reference_number }}</td>						
				</tr>
				<tr>
					<th>Title Deed Number</th>
					<td>{{ $property_flip->title_deed_number }}</td>						
				</tr>
				<tr>
					<th>Case Number</th>
					<td>{{ $property_flip->case_number }}</td>						
				</tr>
				<tr>
					<th>Seller</th>
					<td>
						@if ($property_flip->seller)
							{{ $property_flip->seller->firstname }} {{ $property_flip->seller->surname }}
						@endif
					</td>						
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_SELLING_PRICE))
					<tr>
						<th>Selling Price</th>
						<td>{{ MoneyUtil::toRandsAndFormat($property_flip->selling_price) }}</td>
					</tr>
				@endif
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_SELLER_STATUS))
					<tr>
						<th>Seller Status</th>
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
					<th>Purchaser</th>
					<td>
						@if ($property_flip->purchaser)
							{{ $property_flip->purchaser->firstname }} {{ $property_flip->purchaser->surname }}
						@endif
					</td>						
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PURCHASE_PRICE))
					<tr>
						<th>Purchase Price</th>
						<td>{{ MoneyUtil::toRandsAndFormat($property_flip->purchase_price) }}</td>
					</tr>
				@endif
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_FINANCE_STATUS))
					<tr>
						<th>Finance Status</th>
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
						<th>Property Status</th>
						<td>
							@if ($property_flip->property_status)
								{{ $property_flip->property_status->description }}
							@else
								No property status
							@endif
						</td>
					</tr>
				@endif
			</table>
		</div>
		
		<!-- Attorneys -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_ATTORNEYS))
			<div>
				<div class="main-sub-heading">Attorneys</div>
			</div>
			<div>
				<table>
					<thead>
						<tr>
							<th>Attorney Name</th>
							<th>Firstname</th>
							<th>Surname</th>
							<th>Work Email</th>
							<th>Work Tel No</th>
							<th>Cell No</th>
							<th>Attorney Type</th>
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
		@endif
		
		<!-- Estate Agents -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_ESTATE_AGENTS))
			<div>
				<div class="main-sub-heading">Estate Agents</div>
			</div>
			<div>
				<table>
					<thead>
						<tr>
							<th>Estate Agent Name</th>
							<th>Firstname</th>
							<th>Surname</th>
							<th>Work Email</th>
							<th>Work Tel No</th>
							<th>Cell No</th>
							<th>Estate Agent Type</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($contact_estate_agents) && count($contact_estate_agents) > 0)
							@foreach($contact_estate_agents as $contact_estate_agent)
							<tr>
								<td>{{ $contact_estate_agent->estate_agent_name }}</td>
								<td>{{ $contact_estate_agent->contact_firstname }}</td>
								<td>{{ $contact_estate_agent->contact_surname }}</td>
								<td>{{ $contact_estate_agent->contact_work_email }}</td>
								<td>{{ $contact_estate_agent->contact_work_tel_no }}</td>
								<td>{{ $contact_estate_agent->contact_cell_no }}</td>
								<td>{{ $contact_estate_agent->lookup_estate_agent_type }}</td>
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
		@endif
		
		<!-- Contractors -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_CONTRACTORS))
			<div>
				<div class="main-sub-heading">Contractors</div>
			</div>
			<div>
				<table>
					<thead>
						<tr>
							<th>Contractor Name</th>
							<th>Firstname</th>
							<th>Surname</th>
							<th>Work Email</th>
							<th>Work Tel No</th>
							<th>Cell No</th>
							<th>Contractor Type</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($contact_contractors) && count($contact_contractors) > 0)
							@foreach($contact_contractors as $contact_contractor)
							<tr>
								<td>{{ $contact_contractor->contractor_name }}</td>
								<td>{{ $contact_contractor->contact_firstname }}</td>
								<td>{{ $contact_contractor->contact_surname }}</td>
								<td>{{ $contact_contractor->contact_work_email }}</td>
								<td>{{ $contact_contractor->contact_work_tel_no }}</td>
								<td>{{ $contact_contractor->contact_cell_no }}</td>
								<td>{{ $contact_contractor->lookup_contractor_type }}</td>
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
		@endif
		
		
		<!-- Banks -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_BANKS))
			<div>
				<div class="main-sub-heading">Banks</div>
			</div>
			<div>
				<table>
					<thead>
						<tr>
							<th>Bank Name</th>
							<th>Firstname</th>
							<th>Surname</th>
							<th>Work Email</th>
							<th>Work Tel No</th>
							<th>Cell No</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($bank_contacts) && count($bank_contacts) > 0)
							@foreach($bank_contacts as $bank_contact)
							<tr>
								<td>{{ $bank_contact->bank_name }}</td>
								<td>{{ $bank_contact->contact_firstname }}</td>
								<td>{{ $bank_contact->contact_surname }}</td>
								<td>{{ $bank_contact->contact_work_email }}</td>
								<td>{{ $bank_contact->contact_work_tel_no }}</td>
								<td>{{ $bank_contact->contact_cell_no }}</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="9">No banks</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		@endif
		
		
		<!-- Investors Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_INVESTORS))
			<div>
				<div class="main-sub-heading">Investors</div>
			</div>
			<div>
				<table>
					<thead>
						<tr>
							<th>Firstname</th>
							<th>Surname</th>
							<th>Work Email</th>
							<th>Work Tel No</th>
							<th>Cell No</th>
							<th>Investment Amount</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($contact_investors) && count($contact_investors) > 0)
							@foreach($contact_investors as $contact_investor)
							<tr>
								<td>{{ $contact_investor->contact_firstname }}</td>
								<td>{{ $contact_investor->contact_surname }}</td>
								<td>{{ $contact_investor->contact_work_email }}</td>
								<td>{{ $contact_investor->contact_work_tel_no }}</td>
								<td>{{ $contact_investor->contact_cell_no }}</td>
								<td>{{ MoneyUtil::toRandsAndFormat($contact_investor->investment_amount) }}</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="9">No investors</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		@endif
		
		
		<!-- Milestones Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_MILESTONE))
			<div>
				<div class="main-sub-heading">Milestones</div>
			</div>
			<div>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Milestone Type</th>
							<th>Effective Date</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($property_flip->milestones) && count($property_flip->milestones) > 0)
							@foreach($property_flip->milestones as $milestone)
							<tr>
								<td>{{ $milestone->id }}</td>
								<td>
									@if ($milestone->lookup_milestone_type)
										{{ $milestone->lookup_milestone_type->description }}
									@else
										No Description
									@endif
								</td>
								<td>{{ $milestone->effective_date }}</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="5">No milestones</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		@endif
		
		<!-- Notes Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_NOTE))
			<div>
				<div class="main-sub-heading">Notes</div>
			</div>
			<div>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Description</th>
							<th>Date Created</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($property_flip->notes) && count($property_flip->notes) > 0)
							@foreach($property_flip->notes as $note)
							<tr>
								<td>{{ $note->id }}</td>
								<td>{{ $note->description }}</td>
								<td>{{ $note->created_at }}</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="5">No notes</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		@endif
		
		
		<!-- Transactions Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_TRANSACTION))
			<div>
				<div class="main-sub-heading">Transactions</div>
			</div>
			
			@foreach ($account_transactions as $account_id => $account_with_transactions)
				<div>
					<div class="main-sub-heading">
						@if ($account_with_transactions[0])
							{{ $account_with_transactions[0]->name }}
						@endif
					</div>
				</div>
				<div>
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Effective Date</th>
								<th>Description</th>
								<th>Reference</th>
								<th>Transaction Type</th>
								<th>Debit Amount</th>
								<th>Credit Amount</th>
							</tr>
						</thead>
						<tbody>
							@if (!empty($account_with_transactions[1]) && count($account_with_transactions[1]) > 0)
								@foreach ($account_with_transactions[1] as $transaction)
								<tr>
									<td>{{ $transaction->id }}</td>
									<td>{{ $transaction->effective_date }}</td>
									<td>{{ $transaction->description }}</td>
									<td>{{ $transaction->reference }}</td>
									<td>
										@if ($transaction->transaction_type)
											{{ $transaction->transaction_type->description }}
										@endif
									</td>
									<td>{{ MoneyUtil::toRandsAndFormat($transaction->debit_amount) }}</td>
									<td>{{ MoneyUtil::toRandsAndFormat($transaction->credit_amount) }}</td>
								</tr>
								@endforeach
								<tr>
									<th class="text-right" colspan="5">
										@if ($account_with_transactions[2] > 0)
											Profit
										@elseif ($account_with_transactions[2] < 0)
											Loss
										@else
											Break Even
										@endif
									</th>
									<td colspan="4">{{ MoneyUtil::toRandsAndFormat($account_with_transactions[2]) }}</td>
								</tr>
							@else
								<tr>
									<td colspan="8">No transactions</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			@endforeach
		@endif
	</div>
@endsection
