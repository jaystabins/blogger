@extends('app')

@section('content')

	<div class="row main-content">
		 <div class="col-sm-9 col-sm-push-3 blog-main">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Whoops!</h1>
				</div>
			</div>

				<h3>The page you are looking for could not be found.</h3>
				<h3>Maybe Try to search what you are looking for.</h3>
				{!! Form::open([ 'route' => 'blog.search', 'id' => 'article_form']) !!}
					<div class="form-group">
					    {!! Form::label('term', 'Search:') !!}
					    <div class="input-group">
					        {!! Form::text('term', null, ['id' => 'term', 'class' => 'form-control']) !!}
					        <span class="input-group-btn">
					            {!! Form::submit('Search', ['class' => 'btn btn-default', 'id' => 'submitBtn']) !!}
					        </span>
					    </div>
					    <small class="text-danger">{{ $errors->first('term') }}</small>
					</div>
				{!! Form::close() !!}
		</div>

		@include('partials.sidebar')

	</div>
	
	@include('partials/footer')

@endsection