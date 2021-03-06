<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}</title>

	<link rel="shortcut icon" type="image/png" href="{{ $info->favicon_image }}" />

	<link rel="alternate" type="application/rss+xml" href="{{ url('rss') }}" title="RSS Feed {{ $info->blog_name }}">


	@include('partials/metaSocialMedia')

	<!-- token -->
	<meta name="csrf_token" content="{{ csrf_token() }}" />

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	
	<!-- Font -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>
	<link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>

	<!-- Select 2 for Select boxes -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"/>

	<!-- Data Tables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css"/>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	
	<!-- Sweet Alert -->
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>

	<!-- Add fancyBox -->
	<link rel="stylesheet" href="/js/plugins/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />


	<link rel="stylesheet"href="{{ asset('/css/app.css') }}"/>

</head>
<body>

	<div class="container">

		@include('partials/mainNav')
		
		@yield('content')

	</div>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<!-- Select 2 for Select boxes -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

	<!-- CKeditor -->
	<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>

	<!-- CKFinder -->
	<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>

	<!-- Pretty Print -->
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>

	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<!-- Sweet Alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

	<!-- Add fancyBox -->
	<script src="/js/plugins/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

	@include('sweet::alert')

	@yield('footer')
</body>
</html>
