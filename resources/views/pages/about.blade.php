@extends('app')

@section('content')
	<div class="row main-content">
		 <div class="col-sm-9 col-sm-push-3 blog-main">
				<h1>About Page</h1>
		</div>

		@include('partials.sidebar')
	</div>

	@include('partials/footer')
	
@endsection