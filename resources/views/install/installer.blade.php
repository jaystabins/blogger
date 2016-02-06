<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Install Blog</title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>

	<link rel="stylesheet"href="{{ asset('/css/app.css') }}"/>

</head>
<body>

	<div class="container">

		@yield('content')

	</div>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<!-- CKeditor -->
	<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>

	<!-- CKFinder -->
	<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>

	@yield('footer')
</body>
</html>
