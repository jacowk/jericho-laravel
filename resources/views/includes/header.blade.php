<div class="container">
	<div class="row">
		@yield('breadcrumb')
	</div>
	<div class="row">
		<h4 class="text-center">@yield('title')</h4>
	</div>
	<div class="row">
		@if (isset($errors))
			@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach($errors->all() as $error)
						{{ $error }}
					@endforeach
				</div>
			@endif
		@endif
	</div>
	<div class="row">
		@if(Session::has('message'))
			<div class="alert alert-success">
				{{ Session::get('message') }}
			</div>
		@endif
	</div>
</div>