@extends('layouts.master')

@section('title')
	Leads Per Area Report
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-leads-per-area-report', 'class' => 'form-horizontal')) }}
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
					{{ Form::label('area_id', 'Area', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::select('area_id', $areas, $area_id, ['class' => 'form-control']) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('greater_area_id', 'Greater Area', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::select('greater_area_id', $greater_areas, $greater_area_id, ['class' => 'form-control']) }}
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
	<div class="container">
		<div class="row">
			<div class="panel-heading text-center">
				@if (!empty($properties) && count($properties) > 0)
					<h4 class="panel-title">Leads Per Area Search Result ({{ $properties->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Leads Per Area Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">Property ID</th>
						<th class="col-sm-1 text-center">Reference Number</th>
						<th class="col-sm-2 text-center">Address</th>
						<th class="col-sm-1 text-center">Area</th>
						<th class="col-sm-1 text-center">Suburb</th>
						<th class="col-sm-1 text-center">Greater Area</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($properties) && count($properties) > 0)
						@foreach($properties as $property)
						<tr>
							<td>{{ $property->id }}</td>
							<td>
								@if (!empty($property->reference_number))
									{{ $property->reference_number }}
								@endif
							</td>
							<td>
								{{ $property->address_line_1 }}<br>
								{{ $property->address_line_2 }}<br>
								{{ $property->address_line_3 }}<br>
								{{ $property->address_line_4 }}<br>
								{{ $property->address_line_5 }}<br>
							</td>
							<td>{{ $property->area_name }}</td>
							<td>{{ $property->suburb_name }}</td>
							<td>{{ $property->greater_area_name }}</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="7">No properties</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($properties) && count($properties) > 0)
					@if ($properties->hasMorePages())
						{{ $properties->appends(['from_date' => $from_date, 'to_date' => $to_date, 'area_id' => $area_id, 'greater_area_id' => $greater_area_id])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $properties->appends(['from_date' => $from_date, 'to_date' => $to_date, 'area_id' => $area_id, 'greater_area_id' => $greater_area_id])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($properties->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($properties->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $properties->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $properties->appends(['from_date' => $from_date, 'to_date' => $to_date, 'area_id' => $area_id, 'greater_area_id' => $greater_area_id])->url($properties->lastPage() - 1) }}"><span>{{ $properties->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $properties->appends(['from_date' => $from_date, 'to_date' => $to_date, 'area_id' => $area_id, 'greater_area_id' => $greater_area_id])->url($properties->lastPage()) }}"><span>{{ $properties->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $properties->lastPage(); $i++)
									<li class="{{ ($properties->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $properties->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
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
