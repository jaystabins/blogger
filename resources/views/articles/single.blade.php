@extends('app')

@section('content')
	<div class="row main-content">
		 <div class="col-sm-9 col-sm-push-3 blog-main">
		 	
			<article> 
				<div class="image">
					<img src="{{ $article->featured_image != "" ? $article->featured_image : $info->featured_image }}" alt="" />
				</div>
				<p class="article-info">Posted In 
					@unless($article->categories->isEmpty())
						@foreach($article->categories as $category)
							<a href="{{ url('category', $category->name) }}">{{ $category->name }}</a>
						@endforeach
					@endunless
					{{ ' on ' . date("F j, Y", strtotime($article->published_at)) . " by " . $article->user->name  }}
				</p>
				<div class="text-center article-header">
					<h1>{{ $article->title }}</h1>
					@if($article->subtitle != '')
						<h3 class="text-muted">{{ $article->subtitle }}</h3>
					@endif
				</div>
				<div class="article-body">
					{!! $article->body !!}
				</div>

				<div class="clearfix"></div>
				@if(Auth::check() && Auth::id() == $article->user_id)
						<p><a href="{{ route('blog.edit', ['slug' => $article->slug]) }}">Edit Article</a></p>
				@endif

				@unless($article->tags->isEmpty())
					<div class="row text-center">
						<i class="fa fa-tags"></i>
						@foreach($article->tags as $tag)
							<a class="article-tag" href="{{ url('tags', $tag->name) }}">{{ $tag->name }}</a> &nbsp;
						@endforeach
					</div>
				@endunless

				@if($article->show_sharebar)
					@include('partials.socialSharebar')
				@endif

			</article>
			<div id="disqus_thread"></div>
				<script type="text/javascript">
				    /* * * CONFIGURATION VARIABLES * * */
				    var disqus_shortname = '{{ $blog_info->disqus_shortname }}';
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

@section('footer')

	<script>
		$(document).ready(function() {
			$(".fancybox").fancybox({
		    	openEffect	: 'elastic',
		    	closeEffect	: 'elastic',

		    	helpers : {
		    		title : {
		    			type : 'over'
		    		}
		    	}
		    });
		});
	</script>

@stop