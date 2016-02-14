<ul class="list-inline text-center">
	@if($socialConnect->facebook_active)
		<li><a href="{{ $socialConnect->facebook_url }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
	@endif
	@if($socialConnect->youtube_active)
		<li><a href="{{ $socialConnect->youtube_url }}" target="_blank"><i class="fa fa-youtube"></i> </a></li>
	@endif
	@if($socialConnect->twitter_active)
		<li><a href="{{ $socialConnect->twitter_url }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
	@endif
	@if($socialConnect->googlePlus_active)
		<li><a href="{{ $socialConnect->googlePlus_url }}" target="_blank"><i class="fa fa-google-plus"></i> </a></li>
	@endif
	@if($socialConnect->linkedin_active)
		<li><a href="{{ $socialConnect->linkedin_url }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
	@endif
	@if($socialConnect->pinterest_active)
		<li><a href="{{ $socialConnect->pintrest_url }}" target="_blank"><i class="fa fa-pinterest"></i> </a></li>
	@endif
	@if($socialConnect->instagram_active)
		<li><a href="{{ $socialConnect->instagram_url }}" target="_blank"><i class="fa fa-instagram"></i> </a></li>
	@endif
	@if($socialConnect->github_active)
		<li><a href="{{ $socialConnect->github_url }}" target="_blank"><i class="fa fa-github"></i> </a></li>
	@endif
	@if($socialConnect->rss_active)
		<li><a href="{{ $socialConnect->rss_url }}" target="_blank"><i class="fa fa-rss"></i> </a></li>
	@endif
</ul>