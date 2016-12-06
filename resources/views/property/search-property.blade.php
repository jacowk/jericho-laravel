@extends('layouts.master')

@section('title')
	Search Properties
@endsection

@section('content')
	<div class="container">
		<button class="btn btn-default" data-toggle="collapse" data-target="#search-criteria">View Search Criteria</button>
		
		<div class="row">
			<div id="search-criteria" class="collapse">
				{{ Form::open(array('route' => 'do-search-property', 'class' => 'form-horizontal')) }}
					{{ Form::token() }}
					
					<div class="form-group">
						{{ Form::label('property_id', 'Property ID', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::text('property_id', $property_id, array('class' => 'form-control', 'placeholder' => 'Property ID')) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('propert_flip_id', 'Property Flip ID', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::text('property_flip_id', $property_flip_id, array('class' => 'form-control', 'placeholder' => 'Property Flip ID')) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('reference_number', 'Reference Number', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::text('reference_number', $reference_number, array('class' => 'form-control', 'placeholder' => 'Reference Number')) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('address', 'Address', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::text('address', $address, array('class' => 'form-control', 'placeholder' => 'Address')) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('area_id', 'Area', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::select('area_id', $areas, $area_id, ['class' => 'form-control']) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('suburb_id', 'Suburb', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::select('suburb_id', $suburbs, $suburb_id, ['class' => 'form-control']) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('greater_area_id', 'Greater Area', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::select('greater_area_id', $greater_areas, $greater_area_id, ['class' => 'form-control']) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('finance_status_id', 'Finance Status', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::select('finance_status_id', $finance_statuses, $finance_status_id, ['class' => 'form-control']) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('seller_status_id', 'Seller Status', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::select('seller_status_id', $seller_statuses, $seller_status_id, ['class' => 'form-control']) }}
						</div>
					</div>
					
					<div class="form-group">
						{{ Form::label('property_status_id', 'Property Status', array('class' => 'col-sm-2 control-label')) }}
						<div class="col-sm-10"> 
							{{ Form::select('property_status_id', $property_statuses, $property_status_id, ['class' => 'form-control']) }}
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10"> 
							{{ Form::submit('Search', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{ Form::close() }}
			</div>
		</div>
	</div><br/>
	<div class="container">
		<div class="row">
			<div class="panel-heading text-center">
				@if (!empty($properties) && count($properties) > 0)
					<h4 class="panel-title">Properties Search Result ({{ $properties->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Properties Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">Property ID</th>
						<th class="col-sm-1 text-center">Property Flip ID</th>
						<th class="col-sm-1 text-center">Reference Number</th>
						<th class="col-sm-2 text-center">Address</th>
						<th class="col-sm-1 text-center">Area</th>
						<th class="col-sm-1 text-center">Suburb</th>
						<th class="col-sm-1 text-center">Greater Area</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($properties) && count($properties) > 0)
						@foreach($properties as $property)
						<tr>
							<td>{{ $property->id }}</td>
							<td>
								@if (!empty($property->property_flip_id))
									{{ $property->property_flip_id }}
								@endif
							</td>
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
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY))
								<td><a href="{{ route('update-property', ['property_id' => $property->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-property', ['property_id' => $property->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="9">No properties</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($properties) && count($properties) > 0)
					@if ($properties->hasMorePages())
						{{ $properties->appends(['reference_number' => $reference_number, 'address' => $address, 'area_id' => $area_id, 'suburb_id' => $suburb_id, 'greater_area_id' => $greater_area_id])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $properties->appends(['reference_number' => $reference_number, 'address' => $address, 'area_id' => $area_id, 'suburb_id' => $suburb_id, 'greater_area_id' => $greater_area_id])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($properties->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($properties->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $properties->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $properties->appends(['reference_number' => $reference_number, 'address' => $address, 'area_id' => $area_id, 'suburb_id' => $suburb_id, 'greater_area_id' => $greater_area_id])->url($properties->lastPage() - 1) }}"><span>{{ $properties->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $properties->appends(['reference_number' => $reference_number, 'address' => $address, 'area_id' => $area_id, 'suburb_id' => $suburb_id, 'greater_area_id' => $greater_area_id])->url($properties->lastPage()) }}"><span>{{ $properties->lastPage() }}</span></a></li>
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
		$(document).ready(function() {
			$('#area_id').on('change', function() {
				var area_id = $("#area_id").val();
				var url = "{{ asset('ajax-retrieve-suburbs-for-area') }}";
				$.getJSON(url, {area_id: area_id, ajax: 'true'}, function(data) {
					  $("select#suburb_id").empty();
					  $("select#suburb_id").append('<option value="-1">Select Suburb</option>');
					  $.each(data, function(key, val) {
						  $("select#suburb_id").append('<option value="' + key + '">' + val + '</option>');
					  });
				});
			});
		});
	</script>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_PROPERTY))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-property')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Property', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
