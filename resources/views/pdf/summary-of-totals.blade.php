@extends('layouts.pdf-master')

@section('title')
	Summary Of Totals Report
@endsection

@section('content')
	<div class="page">
		<div>
			<div class="main-heading">Summary Of Totals Report</div>
			<div class="main-sub-heading">{{ $from_date }} to {{ $to_date }}</div><br/>
		</div>
		<div class="row">
			<table>
				<thead>
					<tr>
						<th class="table-heading" colspan="2">Total Number Of Leads</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Total number of leads captured</td>
						<td>{{ $total_properties }}</td>
					</tr>
				</tbody>
				
				@if (!empty($totals_per_seller_status) && count($totals_per_seller_status) > 0)
					<thead>
						<tr>
							<th class="table-heading" colspan="2">Totals per Seller Status</th>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>Status</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($totals_per_seller_status as $total)
							<tr>
								<td>{{ $total->seller_status }}</td>
								<td>{{ $total->cnt }}</td>
							</tr>
						@endforeach
					</tbody>
				@endif
				
				@if (!empty($totals_per_property_status) && count($totals_per_property_status) > 0)
					<thead>
						<tr>
							<th class="table-heading" colspan="2">Totals per Property Status</th>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>Status</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($totals_per_property_status as $total)
							<tr>
								<td>{{ $total->property_status }}</td>
								<td>{{ $total->cnt }}</td>
							</tr>
						@endforeach
					</tbody>
				@endif
				
				@if (!empty($totals_per_greater_area) && count($totals_per_greater_area) > 0)
					<thead>
						<tr>
							<th class="table-heading" colspan="2">Totals per Greater Area</th>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>Greater Area Name</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($totals_per_greater_area as $total)
							<tr>
								<td>{{ $total->greater_area_name }}</td>
								<td>{{ $total->cnt }}</td>
							</tr>
						@endforeach
					</tbody>
				@endif
				
				@if (!empty($totals_per_area) && count($totals_per_area) > 0)
					<thead>
						<tr>
							<th class="table-heading" colspan="2">Totals per Area</th>
						</tr>
					</thead>
					<thead>
						<tr>
							<th>Area Name</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody>
						@foreach($totals_per_area as $total)
							<tr>
								<td>{{ $total->area_name }}</td>
								<td>{{ $total->cnt }}</td>
							</tr>
						@endforeach
					</tbody>
				@endif
				
			</table>
		</div>
	</div>
@endsection
