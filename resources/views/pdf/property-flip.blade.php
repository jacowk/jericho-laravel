@extends('layouts.pdf-master')

@section('title')
	Property Flip Report
@endsection

@section('content')
	<div class="page">
		<div>
			<div class="main-heading">Property Flip Report</div>
			<div class="main-sub-heading">Reference Number {{ $property_flip->reference_number }}</div><br/>
		</div>
		
		<!-- Property Details -->
		<div class="row">
			<div class="main-sub-heading">Property Details</div>
		</div>
		<div class="row">
			<table>
				<tr>
					<th class="table-cell-heading">Address</th>
					<td class="table-cell-content">
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
					<th class="table-cell-content">Suburb</th>
					<td>
						@if ($property->suburb)
							{{ $property->suburb->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="table-cell-content">Area</th>
					<td>
						@if ($property->area)
							{{ $property->area->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="table-cell-content">Greater Area</th>
					<td>
						@if ($property->greater_area)
							{{ $property->greater_area->name }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="table-cell-content">Property Type</th>
					<td>
						@if ($property->lookup_property_type)
							{{ $property->lookup_property_type->description }}
						@endif
					</td>
				</tr>
			</table>
		</div>
		
		
		<!-- Attorneys -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_ATTORNEYS))
			<div class="row">
				<div class="main-sub-heading">Attorneys</div>
			</div>
			<div class="row">
				<table>
					<thead>
						<tr>
							<th class="table-cell-heading">Attorney Name</th>
							<th class="table-cell-heading">Firstname</th>
							<th class="table-cell-heading">Surname</th>
							<th class="table-cell-heading">Work Email</th>
							<th class="table-cell-heading">Work Tel No</th>
							<th class="table-cell-heading">Cell No</th>
							<th class="table-cell-heading">Attorney Type</th>
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
		
		
	</div>
@endsection
