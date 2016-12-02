<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	    <title>@yield('title')</title>
	    
	    <!-- Scripts -->
	    <script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.0.min.js') }}"></script>
	    <!-- <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script> -->
	    
	    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-theme.min.js') }}"></script>
	    
	    <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
	    <script type="text/javascript" src="{{ URL::asset('js/run_prettify.js') }}"></script>
	    <script type="text/javascript" src="{{ URL::asset('js/jquery.bootstrap-duallistbox.js') }}"></script>
	    <script type="text/javascript" src="{{ URL::asset('js/jquery.inputmask.bundle.js') }}"></script>
	    <script type="text/javascript" src="{{ URL::asset('js/jquery.datetimepicker.full.js') }}"></script>
	    
	    <!-- Styles -->
	    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('css/jquery-ui.min.css') }}" rel="stylesheet">
	    
	    <!-- <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet"> -->
	    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
	    
	    <link href="{{ URL::asset('css/prettify.min.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('css/bootstrap-duallistbox.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
	    <link href="{{ URL::asset('css/jericho.css') }}" rel="stylesheet">
	    
	    <script>
	        window.Laravel = <?php echo json_encode([
	            'csrfToken' => csrf_token(),
	        ]); ?>
	    </script>
	</head>
	<body>
	    @include('includes.menu')
		
		@include('includes.header')
		
		@yield('content')
		
		@include('includes.footer')
	</body>
</html>
