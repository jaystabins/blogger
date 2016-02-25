<meta name="description" content="{{ isset($article->excerpt) && !isset($articles) ? strip_tags($article->excerpt) : $info->tagline }}" />
 
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}">
<meta itemprop="description" content="{{ isset($article->excerpt) && !isset($articles) ? strip_tags($article->excerpt) : $info->tagline }}">
<meta itemprop="image" content="{{ isset($article->featured_image) && $article->featured_image != '' && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}">
 
<!-- Twitter Card data -->
<meta name="twitter:card" content="{{ isset($article->featured_image) && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}">
<meta name="twitter:site" content="{{ '@' . basename(parse_url($socialConnect->twitter_url, PHP_URL_PATH)) }}">
<meta name="twitter:title" content="{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}">
<meta name="twitter:description" content="{{ isset($article->excerpt) && !isset($articles) ? strip_tags($article->excerpt) : $info->tagline }}">
<meta name="twitter:creator" content="{{ '@' . basename(parse_url($socialConnect->twitter_url, PHP_URL_PATH)) }}">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="{{ isset($article->featured_image) && $article->featured_image != '' && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}">
 
<!-- Open Graph data -->
<meta property="og:title" content="{{ isset($article->title) && !isset($articles) ? $info->blog_name . ' | ' . $article->title : $info->blog_name }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:image" content="{{ isset($article->featured_image) && $article->featured_image != '' && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image }}" />
<!-- Force Scrape of Page -->
<?php 
	$size = getimagesize(isset($article->featured_image) && $article->featured_image != '' && !isset($articles) ? url() . $article->featured_image : url() . $info->featured_image);
?>
<meta property="og:image:width" content="{{ $size[0] }}"/>
<meta property="og:image:height" content="{{ $size[1] }}"/>
<meta property="og:description" content="{{ isset($article->excerpt) && !isset($articles) ? strip_tags($article->excerpt) : $info->tagline }}" />
<meta property="og:site_name" content="{{ $info->blog_name }}" />
<meta property="article:published_time" content="{{ isset($article->published_at) && !isset($articles) ? $article->published_at : date('Y-m-d') }}" />
<meta property="article:modified_time" content="{{ isset($article->updated_at) && !isset($articles) ? $article->updated_at : date('Y-m-d') }}" />
<meta property="article:section" content="{{ isset($article->excerpt) && !isset($articles) ? strip_tags($article->excerpt) : $info->tagline }}" />
<meta property="article:tag" content="Article Tag" />
<!-- <meta property="fb:admins" content="Facebook numberic ID" /> -->