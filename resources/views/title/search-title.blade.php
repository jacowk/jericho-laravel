@extends('layouts.master')

@section('title')
	Search Titles
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-title', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('description', $description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
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
				@if (!empty($titles) && count($titles) > 0)
					<h4 class="panel-title">Titles Search Result ({{ $titles->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Titles Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TITLE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($titles) && count($titles) > 0)
						@foreach($titles as $title)
						<tr>
							<td>{{ $title->id }}</td>
							<td>{{ $title->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TITLE))
								<td><a href="{{ route('update-title', ['title_id' => $title->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-title', ['title_id' => $title->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No titles</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($titles) && count($titles) > 0)
					@if ($titles->hasMorePages())
						{{ $titles->appends(['description' => $description])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $titles->appends(['description' => $description])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($titles->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($titles->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $titles->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $titles->appends(['description' => $description])->url($titles->lastPage() - 1) }}"><span>{{ $titles->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $titles->appends(['description' => $description])->url($titles->lastPage()) }}"><span>{{ $titles->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $titles->lastPage(); $i++)
									<li class="{{ ($titles->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $titles->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_TITLE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-title')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Title', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
