<meta name="description" content="Page description. No longer than 155 characters." />

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}">
<meta itemprop="description" content="{!! isset($article->excerpt) && !isset($articles)  ? $article->excerpt : $info->tagline !!}">
<meta itemprop="image" content="{{ isset($article->featured_image) && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="{{ isset($article->featured_image) && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}">
<meta name="twitter:site" content="@{{ basename(parse_url($info->twitter_url, PHP_URL_PATH)) }}">
<meta name="twitter:title" content="{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}">
<meta name="twitter:description" content="{!! isset($article->excerpt) && !isset($articles) ? $article->excerpt : $info->tagline !!}">
<meta name="twitter:creator" content="@{{ basename(parse_url($info->twitter_url, PHP_URL_PATH)) }}">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="{{ isset($article->featured_image) && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:image" content="{{ isset($article->featured_image) && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}" />
<meta property="og:description" content="{!! isset($article->subtitle) && !isset($articles) ? $article->subtitle : $info->tagline !!}" />
<meta property="og:site_name" content="{{ $info->blog_name }}" />
<meta property="article:published_time" content="2013-09-17T05:59:00+01:00" />
<meta property="article:modified_time" content="2013-09-16T19:08:47+01:00" />
<meta property="article:section" content="{!! isset($article->excerpt) && !isset($articles) ? $article->excerpt : $info->tagline !!}" />
<meta property="article:tag" content="Article Tag" />
<!-- <meta property="fb:admins" content="Facebook numberic ID" /> -->