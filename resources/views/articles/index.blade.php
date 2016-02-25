@extends('app')

@section('content')
	<div class="row main-content">
		 <div class="col-sm-9 col-sm-push-3 blog-main">
			<article> 
				@foreach ($articles as $article)
				<div class="article-summary">
					<div class="article-header">
						<a href="{{ url('blog', $article->slug) }}">
							<h1>{{ $article->title }}</h1>
						</a>
						@if($article->subtitle != '')
							<h3 class="text-muted">{{ $article->subtitle }}</h3>
						@endif
					</div>
					<div class="image">
						<a href="{{ url('blog', $article->slug) }}">
							<img src="{{ $article->featured_image != "" ? $article->featured_image : $info->featured_image }}" alt="" />
						</a>
					</div>
					<p class="article-info">Posted In 
						@unless($article->categories->isEmpty())
							@foreach($article->categories as $category)
								<a href="{{ url('category', $category->name) }}">{{ $category->name }}</a>
							@endforeach
						@endunless
						{{ ' on ' . date("F j, Y", strtotime($article->published_at)) . " by " . $article->user->name  }}</p>
					<div class="clearfix"> </div>

					<blockquote>{!! $article->excerpt !!} <a href="{{ url('blog', $article->slug) }}">...</a></blockquote>

					@unless($article->tags->isEmpty())
						<div class="row text-center">
							<i class="fa fa-tags"></i>
							@foreach($article->tags as $tag)
								<a class="article-tag" href="{{ url('tags', $tag->name) }}">{{ $tag->name }}</a> &nbsp;
							@endforeach
						</div>
					@endunless

					@if(Auth::check() && Auth::id() == $article->user_id)
						<p>
							<a href="{{ route('blog.edit', ['slug' => $article->slug]) }}">Edit Article</a> 
						</p>
					@endif

					<hr>
				</div>
				@endforeach
			</article>
		{!! $articles->render() !!}
		</div>
		@include('partials.sidebar')

	</div>

	@include('partials/footer')
	
@stop