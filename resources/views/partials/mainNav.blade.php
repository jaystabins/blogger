<nav class="navbar navbar-default navbar-fixed-top is-fixed is-visible">
	<div class="container nav-container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">{{ $info->blog_name }}</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li {!! Request::is('/') ? 'class="active"' : '' !!}>
					<a href="{{ url('/') }}">Home</a>
				</li>
				@foreach($pageMenuItems as $page)
					<li {!! Request::is($page->slug) ? 'class="active"' : '' !!}>
						<a href="{{ url($page->slug) }}">{{ $page->title }}</a>
					</li>
				@endforeach
			</ul>

			<ul class="nav navbar-nav navbar-right">
				@if (Auth::guest())
					<li><a href="{{ url('/auth/login') }}">Login</a></li>
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('/blog/create') }}">Create New Blog Post</a></li>
							<li><a href="{{ url('/blog/manage') }}">Manage Blog</a></li>
            				<li role="separator" class="divider"></li>
							<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
						</ul>
					</li>
				@endif
			</ul>
		</div>
	</div>
</nav>