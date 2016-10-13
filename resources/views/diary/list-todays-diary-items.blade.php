<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Today's Diary Items</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-2 text-center">Address</th>
					<th class="col-sm-6 text-center">Diary Comment</th>
					<th class="col-sm-1 text-center">Diarise Date</th>
					<th class="col-sm-1 text-center">Followup Date</th>
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($todays_diary_items) && count($todays_diary_items) > 0)
					@foreach($todays_diary_items as $todays_diary_item)
					<tr>
						<td>{{ $todays_diary_item->id }}</td>
						<td>
							{{ $todays_diary_item->address_line_1 }}<br>
							@if ($todays_diary_item->address_line_2)
								{{ $todays_diary_item->address_line_2 }}<br>
							@endif
							@if ($todays_diary_item->address_line_3)
								{{ $todays_diary_item->address_line_3 }}<br>
							@endif
							@if ($todays_diary_item->address_line_4)
								{{ $todays_diary_item->address_line_4 }}<br>
							@endif
							@if ($todays_diary_item->address_line_5)
								{{ $todays_diary_item->address_line_5 }}<br>
							@endif
						</td>
						<td>{{ $todays_diary_item->comments }}</td>
						<td>{{ $todays_diary_item->created_at }}</td>
						<td>{{ $todays_diary_item->followup_date }}</td>
						<td><a href="{{ route('view-diary-item', ['diary_item_id' => $todays_diary_item->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="7">No diary items allocated and open for today</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>