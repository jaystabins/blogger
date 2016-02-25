<div class="col-sm-3 col-sm-pull-9 blog-sidebar">
    <div class="sidebar-item">
        <h4>Categories</h4>
        <hr>
        <ol class="list-unstyled">
        @foreach($menuCategories as $category)
            <li><a href="{{url('category', $category->name) }}">{{ $category->name }}</a></li>
        @endforeach
        </ol>
    </div>
    <div class="sidebar-item">
        <h4>Top Tags</h4>
        <hr>
        <ol class="list-unstyled">
        @foreach($top5Tags as $tag)
            <li><a href="{{url('tags', $tag->name) }}">{{$tag->name . ' (' . $tag->total . ')' }}</a></li>
        @endforeach
        </ol>
    </div>
    <div class="sidebar-item">
    	<h4>Latest Articles</h4>
    	<hr>
    	@foreach($latestPosts as $post)
    		<article>
                <i class="fa fa-ticket"></i>
    			<a href="{{ url('blog', $post->slug) }}">
    				{{ $post->title }}
    			</a>
    		</article>
    	@endforeach
    </div>
    <div class="sidebar-item">
        <h4>Archives</h4>
        <hr>
        <ol class="list-unstyled">
        @foreach ($archives as $archive)
            <li><a href="{{url('blog', [$archive->year, $archive->month]) }}">{{ $archive->month_name . ' ' . $archive->year . ' (' . $archive->post_count . ')' }}</a></li>
        @endforeach
        </ol>
    </div>

    <div class="sidebar-item">
        <h4>Search Site</h4>
        <hr>
            {!! Form::open([ 'route' => 'blog.search', 'id' => 'article_form']) !!}
            <div class="form-group">
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
</div>