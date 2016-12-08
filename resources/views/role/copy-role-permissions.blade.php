@extends('layouts.master')

@section('title')
	Copy Role Permissions
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-permission') }}">Search Permission</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="alert alert-info">
				<strong>Info </strong> The permissions for the selected role, will be copied to the {{ $role->name }}.
			</div>
		</div>
		<div class="row">
			{{  Form::open(array('route' => array('do-copy-role-permissions', $role->id), 'class' => 'form-horizontal')) }}
				{{  Form::token() }}
				
				<div class="form-group">
					{{ Form::label('selected_role_id', 'Role To Copy', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{  Form::select('selected_role_id', $roles, '', ['class' => 'form-control']) }}
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						{{ Form::submit('Copy Role Permissions', array('class' => 'btn btn-default')) }}
					</div>
				</div>
			{{  Form::close() }}
		</div>
	</div>
@endsection