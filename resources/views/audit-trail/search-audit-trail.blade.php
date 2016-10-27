@extends('layouts.master')

@section('title')
	Search Audit Trails
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-audit-trail', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('user_id', 'User', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::select('user_id', $users, $user_id, ['class' => 'form-control']) }}
					</div>
				</div>
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
					<div class="col-sm-offset-2 col-sm-10"> 
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div><br/>
	<div class="container">
		<div class="row">
			<div class="panel-heading text-center">
				@if (!empty($audits) && count($audits) > 0)
					<h4 class="panel-title">Audit Trail Search Result ({{ $audits->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Audit Trail Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">Date</th>
						<th class="col-sm-1 text-center">User</th>
						<th class="col-sm-1 text-center">IP Address</th>
						<th class="col-sm-1 text-center">User Action Type</th>
						<th class="col-sm-1 text-center">Auditable Type</th>
						<th class="col-sm-1 text-center">Auditable ID</th>
						<th class="col-sm-3 text-center">Old Record</th>
						<th class="col-sm-3 text-center">New Record</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($audits) && count($audits) > 0)
						@foreach($audits as $audit)
						<tr>
							<td>{{ $audit->created_at }}</td>
							<td>{{ $audit->firstname }} {{ $audit->surname }}</td>
							<td>{{ $audit->ip_address }}</td>
							<td>{{ $audit->type }}</td>
							<td>{{ $audit->auditable_type }}</td>
							<td>{{ $audit->auditable_id }}</td>
							<td>
								@if ($audit->old)
									@if (JSONUtil::isJson($audit->old))
										{!! JSONUtil::convertJSONToString($audit->old) !!}
									@else
										{!! stripslashes(trim($audit->old, '"')) !!}
									@endif
								@endif
							</td>
							<td>
								@if ($audit->new)
									@if (JSONUtil::isJson($audit->new))
										{!! JSONUtil::convertJSONToString($audit->new) !!}
									@else
										{!! stripslashes(trim($audit->new, '"')) !!}
									@endif
								@endif
							</td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="7">No audits</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($audits) && count($audits) > 0)
					@if ($audits->hasMorePages())
						{{ $audits->appends(['user_id' => $user_id, 'from_date' => $from_date, 'to_date' => $to_date])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $audits->appends(['user_id' => $user_id, 'from_date' => $from_date, 'to_date' => $to_date])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($audits->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($audits->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $audits->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $audits->appends(['user_id' => $user_id, 'from_date' => $from_date, 'to_date' => $to_date])->url($audits->lastPage() - 1) }}"><span>{{ $audits->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $audits->appends(['user_id' => $user_id, 'from_date' => $from_date, 'to_date' => $to_date])->url($audits->lastPage()) }}"><span>{{ $audits->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $audits->lastPage(); $i++)
									<li class="{{ ($audits->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $audits->url($i) }}"><span>{{ $i }}</span></a>
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
