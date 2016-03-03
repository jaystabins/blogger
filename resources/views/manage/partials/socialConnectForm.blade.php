<div class="panel-body">
	{!! Form::label('facebook_url', 'Facebook:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-facebook"></i></span>
	    {!! Form::text('facebook_url', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('facebook_active', 0) !!}
			{!! Form::checkbox('facebook_active', true, isset($socialConnect) ? $socialConnect->facebook_active : false, ['id' => 'facebook_active']) !!}
		</span>
	</div>
	{!! Form::label('youtube_url', 'Youtube:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-youtube"></i></span>
	    {!! Form::text('youtube_url', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('youtube_active', 0) !!}
			{!! Form::checkbox('youtube_active', true, isset($socialConnect) ? $socialConnect->youtube_active : false, ['id' => 'youtube_active']) !!}
		</span>
	</div>
	{!! Form::label('twitter_url', 'Twitter:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-twitter"></i></span>
	    {!! Form::text('twitter_url', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('twitter_active', 0) !!}
			{!! Form::checkbox('twitter_active', true, isset($socialConnect) ? $socialConnect->twitter_active : false, ['id' => 'twitter_active']) !!}
		</span>
	</div>
	{!! Form::label('googlePlus_url', 'Google Plus:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-google-plus"></i></span>
	    {!! Form::text('googlePlus_url', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('googlePlus_active', 0) !!}
			{!! Form::checkbox('googlePlus_active', true, isset($socialConnect) ? $socialConnect->googlePlus_active : false, ['id' => 'googlePlus_active']) !!}
		</span>
	</div>
	{!! Form::label('linkedin_url', 'LinkedIn:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-linkedin"></i></span>
	    {!! Form::text('linkedin_url', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('linkedin_active', 0) !!}
			{!! Form::checkbox('linkedin_active', true, isset($socialConnect) ? $socialConnect->linkedin_active : false, ['id' => 'linkedin_active']) !!}
		</span>
	</div>
	{!! Form::label('pinterest_url', 'Pinterest:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-pinterest"></i></span>
	    {!! Form::text('pinterest_url', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('pinterest_active', 0) !!}
			{!! Form::checkbox('pinterest_active', true, isset($socialConnect) ? $socialConnect->pinterest_active : false, ['id' => 'pinterest_active']) !!}
		</span>
	</div>
	{!! Form::label('instagram_url', 'Instagram:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-instagram"></i></span>
	    {!! Form::text('instagram_url', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('instagram_active', 0) !!}
			{!! Form::checkbox('instagram_active', true, isset($socialConnect) ? $socialConnect->instagram_active : false, ['id' => 'instagram_active']) !!}
		</span>
	</div>
	{!! Form::label('github_url', 'Github:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-github"></i></span>
	    {!! Form::text('github_url', null, ['class' => 'form-control']) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('github_active', 0) !!}
			{!! Form::checkbox('github_active', true, isset($socialConnect) ? $socialConnect->github_active : false, ['id' => 'github_active']) !!}
		</span>
	</div>
	{!! Form::label('rss_url', 'RSS:') !!}
	<div class="input-group form-group">
		<span class="input-group-addon" id="basic-addon1"><i class="fa fa-rss"></i></span>
	    {!! Form::text('rss_url', url('/rss'), ['class' => 'form-control', 'disabled' => 'disabled']) !!}
	    {!! Form::hidden('rss_url', url('/rss')) !!}
		<span class="input-group-addon">
        	{!! Form::hidden('rss_active', 0) !!}
			{!! Form::checkbox('rss_active', true, isset($socialConnect) ? $socialConnect->rss_active : false, ['id' => 'rss_active']) !!}
		</span>
	</div>
	{!! Form::submit('Save', ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}
</div>

@section('footer')
	@parent
	<script>
	</script>
@endsection