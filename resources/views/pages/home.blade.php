@extends('app')

@section('content')
	<div class="row main-content">
		 <div class="col-sm-9 col-sm-push-3 blog-main">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

			</div>
		</div>

		<div class="col-sm-3 col-sm-pull-9 blog-sidebar">
			<div class="panel panel-default">
				<div class="panel-heading">Sidebar</div>

			</div>
		</div>
	</div>

	@include('partials/footer')
	
@endsection