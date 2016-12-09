@extends('layouts.master')

@section('title')
	View Property Flip
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-property', ['property_id' => $property_flip->property->id]) }}">View Property</a></li>
</ol>
@endsection

@section('content')
<div class="container">
	
	<ul class="nav nav-tabs" role="tablist">
		<!-- General Tab -->
		@if (!Session::has(TabConstants::ACTIVE_TAB) || (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::GENERAL_TAB))
			<li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
		@else
			<li role="presentation"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
		@endif
		
		<!-- Attorney Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_ATTORNEYS))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::ATTORNEYS_TAB)
				<li role="presentation" class="active"><a id="attorneys-tab" href="#attorneys" aria-controls="attorneys" role="tab" data-toggle="tab">Attorneys</a></li>
			@else
				<li role="presentation"><a id="attorneys-tab" href="#attorneys" aria-controls="attorneys" role="tab" data-toggle="tab">Attorneys</a></li>
			@endif
		@endif
		
		<!-- Estate Agent Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_ESTATE_AGENTS))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::ESTATE_AGENTS_TAB)
				<li role="presentation" class="active"><a id="estate-agents-tab" href="#estate-agents" aria-controls="estate-agents" role="tab" data-toggle="tab">Estate Agents</a></li>
			@else
				<li role="presentation"><a id="estate-agents-tab" href="#estate-agents" aria-controls="estate-agents" role="tab" data-toggle="tab">Estate Agents</a></li>
			@endif
		@endif
		
		<!-- Contractors Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_CONTRACTORS))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::CONTRACTORS_TAB)
				<li role="presentation" class="active"><a id="contractors-tab" href="#contractors" aria-controls="contractors" role="tab" data-toggle="tab">Contractors</a></li>
			@else
				<li role="presentation"><a id="contractors-tab" href="#contractors" aria-controls="contractors" role="tab" data-toggle="tab">Contractors</a></li>
			@endif
		@endif
		
		<!-- Banks Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_BANKS))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::BANKS_TAB)
				<li role="presentation" class="active"><a id="banks-tab" href="#banks" aria-controls="banks" role="tab" data-toggle="tab">Banks</a></li>
			@else
				<li role="presentation"><a id="banks-tab" href="#banks" aria-controls="banks" role="tab" data-toggle="tab">Banks</a></li>
			@endif
		@endif
		
		<!-- Investors Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_INVESTORS))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::INVESTORS_TAB)
				<li role="presentation" class="active"><a id="investors-tab" href="#investors" aria-controls="investors" role="tab" data-toggle="tab">Investors</a></li>
			@else
				<li role="presentation"><a id="investors-tab" href="#investors" aria-controls="investors" role="tab" data-toggle="tab">Investors</a></li>
			@endif
		@endif
		
		<!-- Milestones Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_MILESTONE))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::MILESTONES_TAB)
				<li role="presentation" class="active"><a id="milestones-tab" href="#milestones" aria-controls="milestones" role="tab" data-toggle="tab">Milestones</a></li>
			@else
				<li role="presentation"><a id="milestones-tab" href="#milestones" aria-controls="milestones" role="tab" data-toggle="tab">Milestones</a></li>
			@endif
		@endif
		
		<!-- Notes Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_NOTE))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::NOTES_TAB)
				<li role="presentation" class="active"><a id="notes-tab" href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
			@else
				<li role="presentation"><a id="notes-tab" href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>
			@endif
		@endif
		
		<!-- Documents Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_DOCUMENT))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::DOCUMENTS_TAB)
				<li role="presentation" class="active"><a id="documents-tab" href="#documents" aria-controls="documents" role="tab" data-toggle="tab">Documents</a></li>
			@else
				<li role="presentation"><a id="documents-tab" href="#documents" aria-controls="documents" role="tab" data-toggle="tab">Documents</a></li>
			@endif
		@endif
		
		<!-- Diary Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_DIARY_ITEM))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::DIARY_TAB)
				<li role="presentation" class="active"><a id="diary-tab" href="#diary" aria-controls="diary" role="tab" data-toggle="tab">Diary</a></li>
			@else
				<li role="presentation"><a id="diary-tab" href="#diary" aria-controls="diary" role="tab" data-toggle="tab">Diary</a></li>
			@endif
		@endif
		
		<!-- Transactions Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_TRANSACTION))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::TRANSACTIONS_TAB)
				<li role="presentation" class="active"><a id="transactions-tab" href="#transactions" aria-controls="transactions" role="tab" data-toggle="tab">Transactions</a></li>
			@else
				<li role="presentation"><a id="transactions-tab" href="#transactions" aria-controls="transactions" role="tab" data-toggle="tab">Transactions</a></li>
			@endif
		@endif
	</ul>
	
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- General Tab -->
		@if (!Session::has(TabConstants::ACTIVE_TAB) || (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::GENERAL_TAB))
			<div role="tabpanel" class="tab-pane active" id="general">
		@else
			<div role="tabpanel" class="tab-pane" id="general">
		@endif
			@include('property-flip.general-tab')
		</div>
		
		<!-- Attorneys Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_ATTORNEYS))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::ATTORNEYS_TAB)
				<div role="tabpanel" class="tab-pane active" id="attorneys">
			@else
				<div role="tabpanel" class="tab-pane" id="attorneys">
			@endif
				@include('property-flip.attorney-contacts')
			</div>
		@endif
		
		<!-- Estate Agents Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_ESTATE_AGENTS))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::ESTATE_AGENTS_TAB)
				<div role="tabpanel" class="tab-pane active" id="estate-agents">
			@else
				<div role="tabpanel" class="tab-pane" id="estate-agents">
			@endif
				@include('property-flip.estate-agent-contacts')
			</div>
		@endif
		
		<!-- Contractors Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_CONTRACTORS))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::CONTRACTORS_TAB)
				<div role="tabpanel" class="tab-pane active" id="contractors">
			@else
				<div role="tabpanel" class="tab-pane" id="contractors">
			@endif
				@include('property-flip.contractor-contacts')
			</div>
		@endif
		
		<!-- Banks Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_BANKS))			
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::BANKS_TAB)
				<div role="tabpanel" class="tab-pane active" id="banks">
			@else
				<div role="tabpanel" class="tab-pane" id="banks">
			@endif
				@include('property-flip.bank-contacts')
			</div>
		@endif
		
		<!-- Investors Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_PROPERTY_FLIP_INVESTORS))			
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::INVESTORS_TAB)
				<div role="tabpanel" class="tab-pane active" id="investors">
			@else
				<div role="tabpanel" class="tab-pane" id="investors">
			@endif
				@include('property-flip.investor-contacts')
			</div>
		@endif
			
		<!-- Milestones Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_MILESTONE))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::MILESTONES_TAB)
				<div role="tabpanel" class="tab-pane active" id="milestones">
			@else
				<div role="tabpanel" class="tab-pane" id="milestones">
			@endif
				@include('milestone.list-milestones')
			</div>
		@endif
		
		<!-- Notes Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_NOTE))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::NOTES_TAB)
				<div role="tabpanel" class="tab-pane active" id="notes">
			@else
				<div role="tabpanel" class="tab-pane" id="notes">
			@endif
				@include('note.list-notes')
			</div>
		@endif
		
		<!-- Documents Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_DOCUMENT))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::DOCUMENTS_TAB)
				<div role="tabpanel" class="tab-pane active" id="documents">
			@else
				<div role="tabpanel" class="tab-pane" id="documents">
			@endif
				@include('document.list-documents')
			</div>
		@endif
		
		<!-- Diary Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_DIARY_ITEM))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::DIARY_TAB)
				<div role="tabpanel" class="tab-pane active" id="diary">
			@else
				<div role="tabpanel" class="tab-pane" id="diary">
			@endif
				@include('diary.list-diary-items')
			</div>
		@endif
		
		<!-- Transactions Tab -->
		@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_TRANSACTION))
			@if (Session::has(TabConstants::ACTIVE_TAB) && Session::get(TabConstants::ACTIVE_TAB) == TabConstants::TRANSACTIONS_TAB)
				<div role="tabpanel" class="tab-pane active" id="transactions">
			@else
				<div role="tabpanel" class="tab-pane" id="transactions">
			@endif
				@include('transaction.list-transactions')
			</div>
		@endif
	</div>

</div>
@endsection