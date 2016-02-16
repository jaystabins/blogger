<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}</title>

	<!-- for Google -->
	<meta name="description" content="{{ isset($article->excerpt) && !isset($articles)  ? $article->excerpt : $info->tagline }}" />
	<meta name="keywords" content="{{ isset($article->title) && !isset($articles)  ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}" />

	<meta name="author" content="{{ $info->author }}" />
	<meta name="copyright" content="Copyright {{ $info->blog_name }} <?php echo date('Y'); ?>" />
	<meta name="application-name" content="{{ $info->blog_name }}" />

	<!-- for Facebook -->          
	<meta property="og:title" content="{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="{{ isset($article->featured_image) && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}" />
	<meta property="og:url" content="{{ Request::url() }}" />
	<meta property="og:description" content="{{ isset($article->subtitle) && !isset($articles) ? $article->subtitle : $info->tagline }}" />

	<!-- for Twitter -->          
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:title" content="{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}" />
	<meta name="twitter:description" content="{{ isset($article->subtitle) && !isset($articles) ? $article->subtitle : $info->tagline }}" />
	<meta name="twitter:image" content="{{ isset($article->featured_image) && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}" />

	<meta name="csrf_token" content="{{ csrf_token() }}" />

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"/>

	<!-- Select 2 for Select boxes -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css"/>

	<!-- Data Tables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css"/>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	
	<!-- Sweet Alert -->
	<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>

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

	@include('sweet::alert')
	
	@yield('footer')
</body>
</html>
