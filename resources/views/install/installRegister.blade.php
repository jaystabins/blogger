@extends('install.installer')

@section('content')
<div class="row main-content">
	<div class="container-fluid" id="regInfoForm">
		<div class="row main-content">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Register</div>
					<div class="panel-body">
						<form class="form-horizontal" id="regForm" role="form" method="POST" action="{{ url('/install/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="col-md-4 control-label">Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			    					<small id="nameError" class="text-danger">{{ $errors->first('name') }}</small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">E-Mail Address</label>
								<div class="col-md-6">
									<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			    					<small id="emailError" class="text-danger">{{ $errors->first('email') }}</small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password">
			    					<small id="passwordError" class="text-danger">{{ $errors->first('password') }}</small>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Confirm Password</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password_confirmation">
			    					<small id="password_confirmationError" class="text-danger">{{ $errors->first('password_confirmation') }}</small>
								</div>
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
</div>
@endsection
