<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	    <!-- CSRF Token -->
	    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	    <title>@yield('title')</title>
	    
	    <script>
	        window.Laravel = <?php echo json_encode([
	            'csrfToken' => csrf_token(),
	        ]); ?>
	    </script>
	</head>
	<style>
		.page
		{
			padding: 50px 50px 50px 50px;
		}
		
		.main-heading
		{
			font-family: sans-serif;
			font-size: 20px;
			font-weight: bold;
			text-align: center;
			padding: 10px 10px 10px 10px;
		}
		
		.main-sub-heading
		{
			font-family: sans-serif;
			font-size: 16px;
			text-align: center;
			padding: 10px 10px 10px 10px;
		}
		
		table, th, td
		{
			/* border: 1px solid black; */
			border-bottom: 1px solid #ddd;
			border-collapse: collapse;
			width: 100%;
			padding: 5px;
		}
		
		th
		{
			font-family: sans-serif;
			font-size: 10px;
			font-weight: bold;
			text-align: left;
		}
		
		.table-heading
		{
			font-family: sans-serif;
			font-size: 10px;
			font-weight: bold;
			text-align: center;
		}
		
		td
		{
			font-family: sans-serif;
			font-size: 10px;
			vertical-align: text-top;
		}
	</style>
	<body>
		@yield('content')
	</body>
</html>
