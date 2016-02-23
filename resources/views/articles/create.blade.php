@extends('app')

@section('content')

	<div class="row main-content">
		<div class="panel panel-default">
			<div class="panel-heading">Create a new post</div>

			{!! Form::open([ 'route' => 'blog.store', 'id' => 'article_form']) !!}
				<div class="panel-body">
					<input name="_method" type="hidden" value="POST">
					@include('articles.partials.articleForm', ['submitButtonText' => 'Add Article'])

				</div>
			{!! Form::close() !!}

		</div>
	</div>

@stop
