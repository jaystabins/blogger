@extends('app')

@section('content')

	<div class="row main-content">
		<div class="panel panel-default">
			<div class="panel-heading">Edit: {!! $article->title !!}</div>

			{!! Form::model( $article, [ 'route' => ['blog.update', $article->slug], 'method' => 'PUT', 'id' => 'article_form']) !!}
				<div class="panel-body">

					@include('articles.partials.articleForm', ['submitButtonText' => 'Update Article'])

				
					{!! Form::close() !!}

					{!! Form::open(['route' => ['blog.destroy', $article->slug], 'method' => 'DELETE', 'id' => 'frmDelete']) !!}

						{!! Form::hidden('slug', $article->slug) !!}
						{!! Form::button('Delete Article <i class="fa fa-trash-o"></i>', ['class' => 'btn btn-danger pull-right', 'id' => 'deleteBtn']) !!}

					{!! Form::close() !!}

				</div>
		</div>
	</div>

@stop
