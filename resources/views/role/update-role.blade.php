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
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $role->id }}</p>
				</div>
			</div>
				
			<div class="form-group">
				{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('name', $role->name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('permissions', 'Permission', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<select id="permissions" multiple="multiple" size="10" name="permissions[]">
						@foreach($permissions as $id => $permission)
							@if ($permission['permission_selected'])
								<option value="{{ $permission['html_name'] }}" selected="selected">{{ $permission['name'] }}</option>
							@else
								<option value="{{ $permission['html_name'] }}">{{ $permission['name'] }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Role', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
	<script type="text/javascript">
		$('select[name="permissions[]"]').bootstrapDualListbox({
		});
	</script>
@endsection