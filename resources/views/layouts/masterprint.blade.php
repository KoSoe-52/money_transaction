<!doctype html>
<html lang="en" class="">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" sizes="192x192" href="{{ asset('assets/images/m3.jpg') }}">
	<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" media="print" />
	<style>
		 body {
        font-family: 'Pyidaungsu', Arial, sans-serif;
    }
	</style>
	<!-- Bootstrap JS -->
	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <title>@yield('title')</title>
</head>
<body style="margin:0;padding:9"> 
        @yield('content')
	<script>
		window.print();
	</script>
</body>
</html>