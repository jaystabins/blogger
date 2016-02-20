<div class="panel-body">
	<div class="form-group">
	    {!! Form::label('name', 'Name:') !!}
	    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('name') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('email', 'Email:') !!}
	    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('email') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('password', 'Password:') !!}
	    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('password') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('new_password', 'New Password:') !!}
	    {!! Form::password('new_password', ['class' => 'form-control']) !!}
	    <small class="text-danger">{{ $errors->first('new_password') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('new_password_again', 'New Password Again:') !!}
	    {!! Form::password('new_password_again', ['class' => 'form-control']) !!}
	    <small class="text-danger">{{ $errors->first('new_password_again') }}</small>
	</div>

	{!! Form::submit('Save', ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}
</div>