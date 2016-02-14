<div class="social-share">
	<h4 class="text-center">Share!</h3>
	<ul class="list-inline text-center">
	    <li class="facebook">
	       <!--fb-->
	       <a target="_blank" href="http://www.facebook.com/sharer.php?u={{ Request::url() }}&t={{ $article->title }}" title="Share this post on Facebook!"><i class="fa fa-facebook"></i></a>
	    </li>
	    <li class="twitter">
	       <!--twitter-->
	       <a target="_blank" href="http://twitter.com/home?status={{ urlencode(html_entity_decode($article->title, ENT_COMPAT, 'UTF-8')) }}: {{ Request::url() }}" title="Share this post on Twitter!"><i class="fa fa-twitter"></i></a>
	    </li>
	    <li class="google-plus">
	       <!--g+-->
	       <a target="_blank" href="https://plus.google.com/share?url={{ Request::url() }}" title="Share this post on Google Plus!"><i class="fa fa-google-plus"></i></a>
	    </li>
	    <li class="linkedin">
	       <!--linkedin-->
	       <a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url={{ Request::url() }}&title= {{ urlencode(html_entity_decode( $article->title, ENT_COMPAT, 'UTF-8')) }}&source=LinkedIn" title="Share this post on Linkedin!"><i class="fa fa-linkedin"></i></a>
	    </li>
	    <li class="email-share">
		   <!--Email-->
	       <a title="Share by email" href="mailto:?subject=Check this post - {{ $article->title }}&body={{ Request::url() }}&title={{ $article->title }}" email=""><i class="fa fa-envelope"></i></a>
	    </li>
	</ul>
</div>	