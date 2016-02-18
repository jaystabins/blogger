@extends('install.installer')

@section('content')
<div class="container-fluid">
	<div class="row main-content">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Site Details</div>
				<div class="panel-body">
					<p class="text-center">This is the basic information for your site</p>
					{!! Form::open([ 'route' => 'install.manage', 'id' => 'install_form']) !!}
						<div class="panel-body">

							<div class="form-group">
							    {!! Form::label('blog_name', 'Blog Name:') !!}
							    {!! Form::text('blog_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('blog_name') }}</small>
							</div>
							<div class="form-group">
							    {!! Form::label('tagline', 'Tag Line:') !!}
							    {!! Form::text('tagline', null, ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('tagline') }}</small>
							</div>
							<div class="form-group">
							    {!! Form::label('author', 'Author:') !!}
							    {!! Form::text('author', Auth::user()->name, ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('author') }}</small>
							</div>
							<div class="form-group">
							    {!! Form::label('email', 'Email:') !!}
							    {!! Form::text('email', Auth::user()->email, ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('email') }}</small>
							</div>
							<hr />

							<p class="text-center">Category Information</p>
			                <div class="form-group">
								<div class="form-inline">
				                    <label for="auto_category_menu">Would You Like To Auto Add Categories To Menu?</label>                
				                    {!! Form::select('auto_category_menu', ['No', 'Yes'], null, ['class' => 'form-control pull-right']) !!}
				                </div>
			            	</div>
			                <div class="form-group">
				                <div class="form-inline">
				                    <label for="category_navbar">Would You Like To Add Categories To Main Navbar?</label>                
				                    {!! Form::select('category_navbar', ['No', 'Yes'], null, ['class' => 'form-control pull-right']) !!}
				                </div>
			            	</div>
			                <hr />

							<p class="text-center">Disqus Is intergrated into this site for a commenting system. Create a Disqus Account and enter shortname to use this feature.</p>
			                <div class="form-group">
							    {!! Form::label('disqus_shortname', 'Disqus Shortname:') !!}
			                	<div class="form-inline">
							    	{!! Form::text('disqus_shortname', null, ['class' => 'form-control', 'required' => 'required']) !!}
							    	<a href="https://disqus.com/admin/signup/" target="_blank" type="button" class="btn btn-default pull-right">
								  		<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Create Disqus Account
									</a>
								</div>
							    <small class="text-danger">{{ $errors->first('disqus_shortname') }}</small>
							</div>
			                <hr />

							<p class="text-center">Select a default image for the site.</p>
							<div class="form-group">
							    {!! Form::label('featured_image', 'Featured Image:') !!}
							    <div class="input-group">
							        {!! Form::text('featured_image', null, ['id' => 'featured_image', 'class' => 'form-control', 'readonly' => 'true', 'required' => 'required']) !!}
							        <span class="input-group-btn">
							            <a class="btn btn-default" id="ckfinder-popup">Browse Server</a>
							        </span>
							    </div>
							    <small class="text-danger">{{ $errors->first('featured_image') }}</small>

							    <img src="" id="featured-image" class="img-responsive">
							</div>
							{!! Form::submit('Install', ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer')
<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
	<!-- CKFinder -->
	<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
		$(document).ready(function() {
	        $("#ckfinder-popup").click(function(){
	            selectFIleWithCKFinder('featured_image');
	        });

	        function selectFIleWithCKFinder( elementId ) {
	            CKFinder.modal( {
	                chooseFiles: true,
	                width: 800,
	                height: 600,
	                onInit: function( finder ) {
	                    finder.on( 'files:choose', function( evt ) {
	                        var file = evt.data.files.first();
	                        var output = document.getElementById( elementId );
	                        output.value = file.getUrl();
	                        updateImageDisplay();
	                    } );

	                    finder.on( 'file:choose:resizedImage', function( evt ) {
	                        var output = document.getElementById( elementId );
	                        output.value = evt.data.resizedUrl;
	                    } );
	                }
	            } );
	        }

	        function updateImageDisplay(){
	            $('#featured-image').attr('src', $('#featured_image').val());
	        }
		});
    </script>
@endsection
