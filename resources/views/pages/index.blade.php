@extends('app')

@section('content')
	<div class="row main-content">

	@if($page->show_sidebar)
		<div class="col-sm-9 col-sm-push-3 blog-main">
	@else
		<div class="blog-main">
	@endif

		<h1 class="text-center">{{ $page->title }}</h1>

		@if($page->show_contact_form)
			@include('pages.partials.contactForm')
		@endif

		{!! $page->body !!}

	</div>

	@if($page->show_sidebar)
		@include('partials.sidebar')
	@endif
	
	@include('partials/footer')

@endsection