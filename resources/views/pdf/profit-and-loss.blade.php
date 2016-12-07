@extends('layouts.pdf-master')

@section('title')
	Profit And Loss Report
@endsection

@section('content')
	<div class="page">
		<div>
			<div class="main-heading">Profit And Loss Report</div>
			<div class="main-sub-heading">{{ $from_date }} to {{ $to_date }}</div><br/>
		</div>
		<div class="row">
			<table>
				<thead>
					<tr>
						<th class="table-cell-heading">Reference Number</th>
						<th class="table-cell-heading">Address</th>
						<th class="table-cell-heading">Area</th>
						<th class="table-cell-heading">Suburb</th>
						<th class="table-cell-heading">Greater Area</th>
						<th class="table-cell-heading">Profit</th>
						<th class="table-cell-heading">Loss</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($report_data) && count($report_data) > 0)
						@for ($i = 0; $i < count($report_data); $i++)
							<tr>
								<td class="table-cell-content">{{ $report_data[$i]['property']->reference_number }}</td>
								<td class="table-cell-content">
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
								<td class="table-cell-content">{{ $report_data[$i]['property']->area_name }}</td>
								<td class="table-cell-content">{{ $report_data[$i]['property']->suburb_name }}</td>
								<td class="table-cell-content">{{ $report_data[$i]['property']->greater_area_name }}</td>
								@if ($report_data[$i]['profit_loss_balance'] > 0)
									<td class="table-cell-content">
										{{ MoneyUtil::toRandsAndFormat($report_data[$i]['profit_loss_balance']) }}
									</td>
									<td></td>
								@elseif ($report_data[$i]['profit_loss_balance'] < 0)
									<td></td>
									<td class="table-cell-content">
										{{ MoneyUtil::toRandsAndFormat($report_data[$i]['profit_loss_balance']) }}
									</td>
								@else
									<td class="table-cell-content">Break even</td>
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
@endsection
