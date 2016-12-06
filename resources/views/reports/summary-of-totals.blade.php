@extends('layouts.master')

@section('title')
	Summary Of Totals Report
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-summary-of-totals-report', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				
				<div class="form-group">
					{{  Form::label('from_date', 'From Date', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::text('from_date', $from_date, array('class' => 'form-control', 'placeholder' => 'From Date')) }}
					</div>
				</div>
				<div class="form-group">
					{{  Form::label('to_date', 'To Date', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::text('to_date', $to_date, array('class' => 'form-control', 'placeholder' => 'To Date')) }}
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10"> 
						{{ Form::submit('Search', array('class' => 'btn btn-default')) }}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div><br/>
	@if ($generated)
		<div class="container">
			<div class="row">
				<div class="panel-heading text-center">
					<h4 class="panel-title">Summary Of Totals Report</h4>
				</div>
			</div>
			<div class="row">
				<div class="panel-heading text-center">
					<h5 class="panel-title">{{ $from_date }} to {{ $to_date }}</h5>
				</div>
			</div>
			<div class="row">
				<table class="table table-bordered table-striped table-hover table-condensed">
					<thead>
						<tr>
							<th class="col-sm-1 text-center" colspan="2">Total Number Of Leads</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Total number of leads caputured</td>
							<td>{{ $total_properties }}</td>
						</tr>
					</tbody>
					
					@if (!empty($totals_per_seller_status) && count($totals_per_seller_status) > 0)
						<thead>
							<tr>
								<th class="col-sm-1 text-center" colspan="2">Totals per Seller Status</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th class="col-sm-1 text-center">Status</th>
								<th class="col-sm-1 text-center">Total</th>
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
								<th class="col-sm-1 text-center" colspan="2">Totals per Property Status</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th class="col-sm-1 text-center">Status</th>
								<th class="col-sm-1 text-center">Total</th>
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
								<th class="col-sm-1 text-center" colspan="2">Totals per Greater Area</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th class="col-sm-1 text-center">Greater Area Name</th>
								<th class="col-sm-1 text-center">Total</th>
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
								<th class="col-sm-1 text-center" colspan="2">Totals per Area</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<th class="col-sm-1 text-center">Area Name</th>
								<th class="col-sm-1 text-center">Total</th>
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
		<div class="container">
			<div class="row">
				{{  Form::open(array('route' => array('download-summary-of-totals-report-pdf'), 'class' => 'form-horizontal')) }}
					{{ Form::token() }}
					{{ Form::hidden('from_date', $from_date) }}
					{{ Form::hidden('to_date', $to_date) }}
					{{ Form::submit('Download PDF', array('class' => 'btn btn-default')) }}
				{{  Form::close() }}
			</div>
		</div>
	@endif
	<script type="text/javascript">
		$( function() {
		    $('#from_date').datetimepicker({
				formatTime:'H:i',
				formatDate:'Y-m-d',
				step:5
			});
			
		    $('#to_date').datetimepicker({
				formatTime:'H:i',
				formatDate:'Y-m-d',
				step:5
			});
		});
	</script>
@endsection
