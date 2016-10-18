@extends('layouts.master')

@section('title')
	View Contact
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active">
		@if ($model_view_route === 'search-contact')
			<a href="{{ route($model_view_route) }}">{{ $link_description }}</a>
		@else
			<a href="{{ route($model_view_route, array($model_id_name => $model_id)) }}">{{ $link_description }}</a>
		@endif
	</li>
</ol>
@endsection

@section('content')
	<div class="container">
		<table class="table table-bordered table-striped table-condensed">
			<tr>
				<th class="col-sm-2 text-right">ID</th>
				<td>{{ $contact->id }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Title</th>
				<td>
					@if ($contact->title)
						{{ $contact->title->description }}
					@endif
				</td>
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Firstname</th>
				<td>{{ $contact->firstname }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Surname</th>
				<td>{{ $contact->surname }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Home Tel No</th>
				<td>{{ $contact->home_tel_no }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Work Tel No</th>
				<td>{{ $contact->work_tel_no }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Cell No</th>
				<td>{{ $contact->cell_no }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Fax No</th>
				<td>{{ $contact->fax_no }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Personal Email</th>
				<td>{{ $contact->personal_email }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Work Email</th>
				<td>{{ $contact->work_email }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">ID Number</th>
				<td>{{ $contact->id_number }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Passport Number</th>
				<td>{{ $contact->passport_number }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Marital Status</th>
				<td>
					@if ($contact->marital_status)
						{{ $contact->marital_status->description }}
					@endif
				</td>
			</tr>
			<tr>
				<th class="col-sm-2 text-right">Tax Number</th>
				<td>{{ $contact->tax_number }}</td>						
			</tr>
			<tr>
				<th class="col-sm-2 text-right">SA Citizen</th>
				<td>
					@if ($contact->sa_citizen === 1)
						{{ "Yes" }}
					@else
						{{ "No" }}
					@endif
				</td>						
			</tr>
			@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
				<tr>
					<th class="col-sm-3 text-right">Created By</th>
					<td>
						@if ($contact->created_by)
							{{ $contact->created_by->firstname }} {{ $contact->created_by->surname }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Created At</th>
					<td>{{ $contact->created_at }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Updated By</th>
					<td>
						@if ($contact->updated_by)
							{{ $contact->updated_by->firstname }} {{ $contact->updated_by->surname }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Updated At</th>
					<td>{{ $contact->updated_at }}</td>						
				</tr>
			@endif
		</table>
		<div class="form-inline">
			<div class="form-group">
				{{ Form::open(array('route' => array($model_view_route, $model_id), 'class' => 'form-horizontal')) }}
					{{ Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit($link_description, array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{ Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTACT))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-contact', $contact->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						{{ Form::hidden('model_id', $model_id) }}
						{{ Form::hidden('model_name', $model_id_name) }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Update Contact', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection