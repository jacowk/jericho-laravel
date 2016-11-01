<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">

			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}">
				@if (Auth::guest())
					{{ config('app.name', 'Jericho') }} - Welcome
				@else
					{{ config('app.name', 'Jericho') }} - Welcome {{ Auth::user()->firstname }} {{ Auth::user()->surname }}
				@endif
			</a>
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">
				&nbsp;
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@if (Auth::guest())
					<li><a href="{{ url('/login') }}">Login</a></li>
					<li><a href="{{ url('/register') }}">Register</a></li>
				@else
					<li><a href="{{ url('/home') }}">Home</a></li>
					<li><a href="{{ url('/view-profile') }}">User Account</a></li>
					@if (MenuDisplayValidator::canDisplayPropertiesMenu())
						<li><a href="{{ url('/search-property') }}">Properties</a></li>
					@endif
					
					@if (MenuDisplayValidator::canDisplayLookupsMenu())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Lookups <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								@if (MenuDisplayValidator::canDisplayAccountsMenu())
									<li><a href="{{ url('/search-account') }}">Accounts</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayGreaterAreasMenu())
									<li><a href="{{ url('/search-greater-area') }}">Greater Areas</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayAreasMenu())
									<li><a href="{{ url('/search-area') }}">Areas</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplaySuburbsMenu())
									<li><a href="{{ url('/search-suburb') }}">Suburbs</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayAttorneyTypesMenu())
									<li><a href="{{ url('/search-attorney-type') }}">Attorney Types</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayContractorTypesMenu())
									<li><a href="{{ url('/search-contractor-type') }}">Contractor Types</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayDocumentTypesMenu())
									<li><a href="{{ url('/search-document-type') }}">Document Types</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayEstateAgentTypesMenu())
									<li><a href="{{ url('/search-estate-agent-type') }}">Estate Agent Types</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayMaritalStatusesMenu())
									<li><a href="{{ url('/search-marital-status') }}">Marital Statuses</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayPropertyTypesMenu())
									<li><a href="{{ url('/search-property-type') }}">Property Types</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayMilestoneTypesMenu())
									<li><a href="{{ url('/search-milestone-type') }}">Milestone Types</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayTitlesMenu())
									<li><a href="{{ url('/search-title') }}">Titles</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayTransactionTypesMenu())
									<li><a href="{{ url('/search-transaction-type') }}">Transaction Types</a></li>
								@endif
								<!-- <li><a href="{{ url('/test') }}">Test</a></li> -->
							</ul>
						</li>
					@endif
					
					@if (MenuDisplayValidator::canDisplayThirdPartiesMenu())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Third Parties <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								@if (MenuDisplayValidator::canDisplayAttorneysMenu())
									<li><a href="{{ url('/search-attorney') }}">Attorneys</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayBanksMenu())
									<li><a href="{{ url('/search-bank') }}">Banks</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayContactsMenu())
									<li><a href="{{ url('/search-contact') }}">Contacts</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayContractorsMenu())
									<li><a href="{{ url('/search-contractor') }}">Contractors</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayEstateAgentsMenu())
									<li><a href="{{ url('/search-estate-agent') }}">Estate Agents</a></li>
								@endif
							</ul>
						</li>
					@endif
					
					@if (MenuDisplayValidator::canDisplayReportsMenu())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Reports <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								@if (MenuDisplayValidator::canDisplayLeadsToSalesMenu())
									<li><a href="{{ url('/leads-to-sales-report') }}">Leads to Sales</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayAmountOfLeadsActionedMenu())
									<li><a href="#">Amount of Leads Actioned</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayLeadsPerAreaMenu())
									<li><a href="{{ url('/leads-per-area-report') }}">Leads per Area</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayProfitAndLossByDateMenu())
									<li><a href="#">Profit and Loss by Date</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayTotalsPerStatusMenu())
									<li><a href="#">Totals per Status</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplaySummaryOfTotalsMenu())
									<li><a href="#">Summary Of Totals</a></li>
								@endif
							</ul>
						</li>
					@endif
					
					@if (MenuDisplayValidator::canDisplayAdminMenu())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Admin <span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								@if (MenuDisplayValidator::canDisplayPermissionsMenu())
									<li><a href="{{ url('/search-permission') }}">Permissions</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayRolesMenu())
									<li><a href="{{ url('/search-role') }}">Roles</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayUsersMenu())
									<li><a href="{{ url('/search-user') }}">Users</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayAuditTrailMenu())
									<li><a href="{{ url('/search-audit-trail') }}">Audit Trailing</a></li>
								@endif
								
								@if (MenuDisplayValidator::canDisplayIssueTrackerMenu())
									<li><a href="{{ url('/search-issue') }}">Issue Tracker</a></li>
								@endif
							</ul>
						</li>
					@endif
					
					
					<li>
						<a href="{{ url('/logout') }}"
							onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							Logout
						</a>
			
						<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>