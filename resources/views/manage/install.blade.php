<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Install Blog</title>
	<link rel="stylesheet"href="{{ asset('/css/app.css') }}"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
	<div class="container">
		<div class="row main-content">
			<div class="panel-heading">Blog Settings</div>

			<div class="container-fluid" id="regInfoForm">
				<div class="row main-content">
					<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-default">
							<div class="panel-heading">Register</div>
							<div class="panel-body">
								<form class="form-horizontal" id="regForm" role="form" method="POST" action="{{ url('/blog/manage/register') }}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">

									<div class="form-group">
										<label class="col-md-4 control-label">Name</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="name" value="{{ old('name') }}">
										</div>
					    				<small id="nameError" class="text-danger">{{ $errors->first('name') }}</small>
									</div>

									<div class="form-group">
										<label class="col-md-4 control-label">E-Mail Address</label>
										<div class="col-md-6">
											<input type="email" class="form-control" name="email" value="{{ old('email') }}">
										</div>
					    				<small id="emailError" class="text-danger">{{ $errors->first('email') }}</small>
									</div>

									<div class="form-group">
										<label class="col-md-4 control-label">Password</label>
										<div class="col-md-6">
											<input type="password" class="form-control" name="password">
										</div>
					    				<small id="passwordError" class="text-danger">{{ $errors->first('password') }}</small>
									</div>

									<div class="form-group">
										<label class="col-md-4 control-label">Confirm Password</label>
										<div class="col-md-6">
											<input type="password" class="form-control" name="password_confirmation">
										</div>
					    				<small id="password_confirmationError" class="text-danger">{{ $errors->first('password_confirmation') }}</small>
									</div>

									<div class="form-group">
										<div class="col-md-6 col-md-offset-4">
											<button type="submit" class="btn btn-primary">
												Register
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid" id="info-update">
				<div class="row main-content">
					<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-default">
							<div class="panel-heading">Register</div>
							<div class="panel-body">
								{!! Form::open([ 'route' => 'blog.manage.install', 'id' => 'install_form']) !!}
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
										    {!! Form::text('author', null, ['class' => 'form-control', 'required' => 'required']) !!}
										    <small class="text-danger">{{ $errors->first('author') }}</small>
										</div>
										<div class="form-group">
										    {!! Form::label('featured_image', 'Featured Image:') !!}
										    <div class="input-group">
										        {!! Form::text('featured_image', null, ['id' => 'featured_image', 'class' => 'form-control', 'readonly' => 'true', 'required' => 'required']) !!}
										        <span class="input-group-btn">
										            <a class="btn btn-default" id="ckfinder-popup">Browse Server</a>
										        </span>
										    </div>
										    <small class="text-danger">{{ $errors->first('featured_image') }}</small>

										    <img src="" id="featured-image">
										</div>
										{!! Form::submit('Install', ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}
									</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		</div>
	</div>
</body>	
<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
	<!-- CKFinder -->
	<script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <script>
		$(document).ready(function() {
			//Hide the blog info by default
			$('#info-update').hide();

			//submit the registration form via ajax
			$('#regForm').submit(function(event) {
				event.preventDefault();
			    
			    $.ajaxSetup({
			        header:$('meta[name="csrf-token"]').attr('content')
			    })

			    $.ajax({
			    	type: "POST",
			    	url: $(this).attr('action'), 
			    	data: $(this).serialize(),
			    	dataType: 'json',
			    	success: function(data){
			    		$('#regInfoForm').toggle();
			    		$('#info-update').toggle();
			    	},
			    	error: function(data){
			    		var errors =  $.parseJSON(data.responseText);
			    		$.each(errors, function(index, value) {
			    			console.log(index);
			    			$('#' + index + 'Error').val('dummy');//value[1]);
			    		})
			    	}
			    })
			});

			$('#featured-image').attr('src', $('#featured_image').val());

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
</html>
