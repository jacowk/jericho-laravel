@extends('layouts.master')

@section('title')
	View Property
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-property') }}">Search Property</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
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
					<td>{{ $property->suburb->name }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Area</th>
					<td>{{ $property->area->name }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Greater Area</th>
					<td>{{ $property->greater_area->name }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Portion Number</th>
					<td>{{ $property->portion_number }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Erf Number</th>
					<td>{{ $property->erf_number }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Size</th>
					<td>{{ $property->size }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Property Type</th>
					<td>
						@if ($property->lookup_property_type)
							{{ $property->lookup_property_type->description }}
						@endif
					</td>
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($property->created_by)
								{{ $property->created_by->firstname }} {{ $property->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $property->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($property->updated_by)
								{{ $property->updated_by->firstname }} {{ $property->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $property->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-property', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Back to Search Property', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-property', $property->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Update Property', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP))
		<div class="container">
			<div class="row">
				<div class="panel-heading text-center">
					<h4 class="panel-title">Property Flips</h4>
				</div>
			</div>
			<div class="row">
				<table class="table table-bordered table-striped table-hover table-condensed">
					<thead>
						<tr>
							<th class="col-sm-1 text-center">ID</th>
							<th class="col-sm-2 text-center">Reference Number</th>
							<th class="col-sm-2 text-center">Title Deed Number</th>
							<th class="col-sm-2 text-center">Case Number</th>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY_FLIP))
								<th class="col-sm-1 text-center">Update</th>
							@endif
							<th class="col-sm-1 text-center">View</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($property->property_flips) && count($property->property_flips) > 0)
							@for($i = 0; $i < count($property->property_flips); $i++)
							<tr>
								<td>{{ $property->property_flips[$i]->id }}</td>
								<td>{{ $property->property_flips[$i]->reference_number }}</td>
								<td>{{ $property->property_flips[$i]->title_deed_number }}</td>
								<td>{{ $property->property_flips[$i]->case_number }}</td>
								@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY_FLIP))
									<td><a href="{{ route('update-property-flip', ['property_flip_id' => $property->property_flips[$i]->id]) }}">Update</a></td>
								@endif
								<td><a href="{{ route('view-property-flip', ['property_flip_id' => $property->property_flips[$i]->id]) }}">View</a></td>
							</tr>
							@endfor
						@else
							<tr>
								<td colspan="7">No property flips</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
		@if (PermissionValidator::hasPermission(PermissionConstants::ADD_PROPERTY_FLIP))
			<div class="container">
				<div class="row">
					{{  Form::open(array('route' => array('add-property-flip', $property->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Add Property Flip</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			</div>
		@endif
	@endif
@endsection