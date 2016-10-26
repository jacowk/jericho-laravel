@extends('layouts.master')

@section('title')
	Search Contacts
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-contact', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				
				<div class="form-group">
					{{ Form::label('firstname', 'Firstname', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('firstname', $firstname, array('class' => 'form-control', 'placeholder' => 'Firstname')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('surname', 'Surname', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::text('surname', $surname, array('class' => 'form-control', 'placeholder' => 'Surname')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('work_email', 'Work Email', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::text('work_email', $work_email, array('class' => 'form-control', 'placeholder' => 'Work Email')) }}
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
	
	@section('contact-list-title')
		Contacts Search Result
	@endsection
	
	@include('contact.list-contacts')
	
	<!-- Pagination -->
	<div class="text-center">
		@if (!empty($contacts) && count($contacts) > 0)
			@if ($contacts->hasMorePages())
				{{ $contacts->appends(['firstname' => $firstname, 'surname' => $surname, 'work_email' => $work_email])->render() }}<br/>
			@else
				<ul class="pagination">
					<li><a href="{{ $contacts->appends(['firstname' => $firstname, 'surname' => $surname, 'work_email' => $work_email])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
					@if ($contacts->lastPage() > 10)
						@for ($i = 1; $i <= 5; $i++)
							<li class="{{ ($contacts->currentPage() == $i) ? ' active' : '' }}">
								<a href="{{ $contacts->url($i) }}"><span>{{ $i }}</span></a>
							</li>
						@endfor
						<li><span>...</span></li>
						<li><a href="{{ $contacts->appends(['firstname' => $firstname, 'surname' => $surname, 'work_email' => $work_email])->url($contacts->lastPage() - 1) }}"><span>{{ $contacts->lastPage() - 1 }}</span></a></li>
						<li><a href="{{ $contacts->appends(['firstname' => $firstname, 'surname' => $surname, 'work_email' => $work_email])->url($contacts->lastPage()) }}"><span>{{ $contacts->lastPage() }}</span></a></li>
					@else
						@for ($i = 1; $i <= $contacts->lastPage(); $i++)
							<li class="{{ ($contacts->currentPage() == $i) ? ' active' : '' }}">
								<a href="{{ $contacts->url($i) }}"><span>{{ $i }}</span></a>
							</li>
						@endfor
					@endif
				</ul>
			@endif
		@endif
	</div>
	
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTACT))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-contact')) }}
					{{ Form::token() }}
					{{ Form::hidden('model_name', 'none') }}
					{{ Form::hidden('model_id', '0') }}
					{{ Form::submit('Add Contact', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
