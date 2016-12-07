@extends('layouts.master')

@section('title')
	Profit And Loss Report
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-profit-and-loss-report', 'class' => 'form-horizontal')) }}
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
					<h4 class="panel-title">Profit And Loss Report</h4>
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
							<th class="col-sm-1 text-center">Reference Number</th>
							<th class="col-sm-1 text-center">Address</th>
							<th class="col-sm-1 text-center">Area</th>
							<th class="col-sm-1 text-center">Suburb</th>
							<th class="col-sm-1 text-center">Greater Area</th>
							<th class="col-sm-1 text-center">Profit</th>
							<th class="col-sm-1 text-center">Loss</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($report_data) && count($report_data) > 0)
							@for ($i = 0; $i < count($report_data); $i++)
								<tr>
									<td>{{ $report_data[$i]['property']->reference_number }}</td>
									<td>
										@if ($report_data[$i]['property']->address_line_1 != null)
											{{ $report_data[$i]['property']->address_line_1 }}<br>
										@endif
										@if ($report_data[$i]['property']->address_line_2 != null)
											{{ $report_data[$i]['property']->address_line_2 }}<br>
										@endif
										@if ($report_data[$i]['property']->address_line_3 != null)
											{{ $report_data[$i]['property']->address_line_3 }}<br>
										@endif
										@if ($report_data[$i]['property']->address_line_4 != null)
											{{ $report_data[$i]['property']->address_line_4 }}<br>
										@endif
										@if ($report_data[$i]['property']->address_line_5 != null)
											{{ $report_data[$i]['property']->address_line_5 }}<br>
										@endif
									</td>
									<td>{{ $report_data[$i]['property']->area_name }}</td>
									<td>{{ $report_data[$i]['property']->suburb_name }}</td>
									<td>{{ $report_data[$i]['property']->greater_area_name }}</td>
									@if ($report_data[$i]['profit_loss_balance'] > 0)
										<td>
											{{ MoneyUtil::toRandsAndFormat($report_data[$i]['profit_loss_balance']) }}
										</td>
										<td></td>
									@elseif ($report_data[$i]['profit_loss_balance'] < 0)
										<td></td>
										<td>
											{{ MoneyUtil::toRandsAndFormat($report_data[$i]['profit_loss_balance']) }}
										</td>
									@else
										<td>Break even</td>
										<td></td>
									@endif
								</tr>
							@endfor
						@else
							<tr>
								<td colspan="7">No data found</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
		<div class="container">
			<div class="row">
				{{  Form::open(array('route' => array('download-profit-and-loss-report-pdf'), 'class' => 'form-horizontal')) }}
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
