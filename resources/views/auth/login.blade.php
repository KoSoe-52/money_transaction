<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
    <link rel="icon" sizes="192x192" href="{{asset('assets/images/logo.png')}}">
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js') }}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<title>A applications - Login</title>
</head>
<body class="bg-gradient-info">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-lock-screen d-flex align-items-center justify-content-center">
			<div class="card shadow-none bg-transparent">
                <form method="POST" action="{{ route('mylogin') }}" >
                    @csrf
                    <div class="card-body p-md-3 text-center" style="width:350px">
                        <h5 class="text-white">A Application Login</h5>
                        <div class="">
                            <img src="{{ asset('assets/images/logo.png') }}" class="mt-2" width="120" alt="" style="border-radius:50%" />
                        </div>
                        <!-- <label for="username" class="mt-2 text-white form-label">Username</label> -->
                        <div class="input-group mt-3">
                            <span class="input-group-text bg-transparent">
                                <i class="bx bxs-user text-success"></i>
                            </span>
                            <input type="text"  id="username" class="form-control" name="username" placeholder="Username" autocomplete="off" />
                        </div>
                        <!-- <p class="mt-2 text-white" style="text-align:left">Password</p> -->
                        <div class="input-group mt-3">
                            <span class="input-group-text bg-transparent">
                                <i class="bx bxs-key text-success"></i>
                            </span>
                            <input type="password" class="form-control" name="password" placeholder="Password" />
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-white">Login</button>
                        </div>
                        @if(session('status'))
                            <span class="text-danger">{{ session('status') }}</span>
                        @endif
                        @if(count($errors->all()) > 0)
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-danger">{{$error}}</li>
                                @endforeach             
                            </ul>
                        @endif
                    </div>
                </form>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>
</html>