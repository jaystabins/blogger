@extends('app')

@section('content')
	<div class="row main-content">

	@if($page->show_sidebar)
		<div class="col-sm-9 col-sm-push-3 blog-main">
	@else
		<div class="blog-main">
	@endif

		<h1 class="text-center">{{ $page->title }}</h1>

		{!! $page->body !!}

		@if($page->show_contact_form)
			@include('pages.partials.contactForm')
		@endif

	</div>

	@if($page->show_sidebar)
		@include('partials.sidebar')
	@endif
	
	@include('partials/footer')

@endsection