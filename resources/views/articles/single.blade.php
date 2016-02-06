@extends('app')

@section('content')
	<div class="row main-content">
		 <div class="col-sm-9 col-sm-push-3 blog-main">
		 	
			<article> 
				<div class="image">
					<img src="{{ $article->featured_image != "" ? $article->featured_image : $info->featured_image }}" alt="" />
					<h2><span>{{ $article->title }}</span><br />
					<span>{{ $article->subtitle }}</span></h2>
				</div>
				<p class="article-info">Posted In 
					@unless($article->categories->isEmpty())
						@foreach($article->categories as $category)
							<a href="{{ url('category', $category->name) }}">{{ $category->name }}</a>
						@endforeach
					@endunless
					{{ ' on ' . date("F j, Y", strtotime($article->published_at)) . " by " . $article->user->name  }}
				</p>
				<p>
					{!! $article->body !!}
				</p>

				<div class="clearfix"></div>
				@if(Auth::check() && Auth::id() == $article->user_id)
						<p><a href="{{ route('blog.edit', ['slug' => $article->slug]) }}">Edit Article</a></p>
				@endif

				@unless($article->tags->isEmpty())
					<p>
						<big>Tags:</big>
						@foreach($article->tags as $tag)
							<a href="{{ url('tags', $tag->name) }}">{{ $tag->name }}</a> &nbsp;
						@endforeach
					</p>
				@endunless

			</article>
			<div id="disqus_thread"></div>
				<script type="text/javascript">
				    /* * * CONFIGURATION VARIABLES * * */
				    var disqus_shortname = 'smashub';
				    var disqus_disqus_identifier = '{{ $article->id }}';
				    var disqus_title = '{{ $article->title }}';
				    var disqus_url = '{!! Request::url() !!}';


				    /* * * DON'T EDIT BELOW THIS LINE * * */
				    (function() {
				        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
				        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
				        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
				    })();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
		</div>

		@include('partials.sidebar')

	@include('partials/footer')

@stop