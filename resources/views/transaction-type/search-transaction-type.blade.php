@extends('layouts.master')

@section('title')
	Search Transaction Types
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-transaction-type', 'class' => 'form-horizontal')) }}
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
				@if (!empty($transaction_types) && count($transaction_types) > 0)
					<h4 class="panel-title">Transaction Types Search Result ({{ $transaction_types->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Transaction Types Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION_TYPE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($transaction_types) && count($transaction_types) > 0)
						@foreach($transaction_types as $transaction_type)
						<tr>
							<td>{{ $transaction_type->id }}</td>
							<td>{{ $transaction_type->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_TRANSACTION_TYPE))
								<td><a href="{{ route('update-transaction-type', ['transaction_type_id' => $transaction_type->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-transaction-type', ['transaction_type_id' => $transaction_type->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No transaction types</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($transaction_types) && count($transaction_types) > 0)
					@if ($transaction_types->hasMorePages())
						{{ $transaction_types->appends(['description' => $description])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $transaction_types->appends(['description' => $description])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($transaction_types->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($transaction_types->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $transaction_types->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $transaction_types->appends(['description' => $description])->url($transaction_types->lastPage() - 1) }}"><span>{{ $transaction_types->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $transaction_types->appends(['description' => $description])->url($transaction_types->lastPage()) }}"><span>{{ $transaction_types->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $transaction_types->lastPage(); $i++)
									<li class="{{ ($transaction_types->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $transaction_types->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_TRANSACTION_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-transaction-type')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Transaction Type', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
