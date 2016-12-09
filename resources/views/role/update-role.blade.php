@extends('layouts.master')

@section('title')
	Update Role
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-role') }}">Search Role</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-role', $role->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			
			<div class="row">
				<div class="form-group">
					{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						<p>{{ $role->id }}</p>
					</div>
				</div>
			</div>
				
			<div class="row">
				<div class="form-group">
					{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::text('name', $role->name, array('class' => 'form-control captialize', 'placeholder' => 'Name')) }}
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6">
					<h4>Admin Permissions</h4>
				</div>
				<div class="col-sm-6">
					<h4>Report Permissions</h4>
				</div>
				<div class="col-sm-6">
					<select id="admin_permissions" 
							multiple="multiple" 
							size="10" 
							name="admin_permissions[]"
							style="height: 250px">
						@foreach($admin_permissions as $id => $permission)
							@if ($permission['permission_selected'])
								<option value="{{ $permission['html_name'] }}" selected="selected">{{ $permission['name'] }}</option>
							@else
								<option value="{{ $permission['html_name'] }}">{{ $permission['name'] }}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="col-sm-6">
					<select id="report_permissions" 
							multiple="multiple" 
							size="10" 
							name="report_permissions[]"
							style="height: 250px">
						@foreach($report_permissions as $id => $permission)
							@if ($permission['permission_selected'])
								<option value="{{ $permission['html_name'] }}" selected="selected">{{ $permission['name'] }}</option>
							@else
								<option value="{{ $permission['html_name'] }}">{{ $permission['name'] }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6">
					<h4>Third Party Permissions</h4>
				</div>
				<div class="col-sm-6">
					<h4>Lookup Permissions</h4>
				</div>
				<div class="col-sm-6">
					<select id="third_party_permissions" 
							multiple="multiple" 
							size="10" 
							name="third_party_permissions[]"
							style="height: 250px">
						@foreach($third_party_permissions as $id => $permission)
							@if ($permission['permission_selected'])
								<option value="{{ $permission['html_name'] }}" selected="selected">{{ $permission['name'] }}</option>
							@else
								<option value="{{ $permission['html_name'] }}">{{ $permission['name'] }}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="col-sm-6">
					<select id="lookup_permissions" 
							multiple="multiple" 
							size="10" 
							name="lookup_permissions[]"
							style="height: 250px">
						@foreach($lookup_permissions as $id => $permission)
							@if ($permission['permission_selected'])
								<option value="{{ $permission['html_name'] }}" selected="selected">{{ $permission['name'] }}</option>
							@else
								<option value="{{ $permission['html_name'] }}">{{ $permission['name'] }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6">
					<h4>Property Permissions</h4>
				</div>
				<div class="col-sm-6">
					<h4>Global Permissions</h4>
				</div>
				<div class="col-sm-6">
					<select id="property_permissions" 
							multiple="multiple" 
							size="10" 
							name="property_permissions[]"
							style="height: 250px">
						@foreach($property_permissions as $id => $permission)
							@if ($permission['permission_selected'])
								<option value="{{ $permission['html_name'] }}" selected="selected">{{ $permission['name'] }}</option>
							@else
								<option value="{{ $permission['html_name'] }}">{{ $permission['name'] }}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div class="col-sm-6">
					<select id="global_permissions" 
							multiple="multiple" 
							size="10" 
							name="global_permissions[]"
							style="height: 250px">
						@foreach($global_permissions as $id => $permission)
							@if ($permission['permission_selected'])
								<option value="{{ $permission['html_name'] }}" selected="selected">{{ $permission['name'] }}</option>
							@else
								<option value="{{ $permission['html_name'] }}">{{ $permission['name'] }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<div>
						<br/>
						{{ Form::submit('Update Role', array('class' => 'btn btn-default')) }}
					</div>
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<script type="text/javascript">
		$('select[name="permissions[]"]').bootstrapDualListbox();
		$('select[name="admin_permissions[]"]').bootstrapDualListbox();
		$('select[name="report_permissions[]"]').bootstrapDualListbox();
		$('select[name="third_party_permissions[]"]').bootstrapDualListbox();
		$('select[name="lookup_permissions[]"]').bootstrapDualListbox();
		$('select[name="property_permissions[]"]').bootstrapDualListbox();
		$('select[name="global_permissions[]"]').bootstrapDualListbox();
	</script>
@endsection