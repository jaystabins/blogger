<div class="panel-body">
	<div class="form-group">
	    {!! Form::label('driver', 'Driver:') !!}
	    {!! Form::text('driver', null, ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('driver') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('host', 'Host:') !!}
	    {!! Form::text('host', null, ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('host') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('port', 'Port:') !!}
	    {!! Form::text('port', null, ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('port') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('from_address', 'Email:') !!}
	    {!! Form::text('from_address', null, ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('from_address') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('from_name', 'Name:') !!}
	    {!! Form::text('from_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('from_name') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('encryption', 'Encryption:') !!}
	    {!! Form::text('encryption', null, ['class' => 'form-control']) !!}
	    <small class="text-danger">{{ $errors->first('encryption') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('username', 'User Name:') !!}
	    {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('username') }}</small>
	</div>
	<div class="form-group">
	    {!! Form::label('password', 'Password:') !!}
	    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
	    <small class="text-danger">{{ $errors->first('password') }}</small>
	</div>
	<button class="btn btn-default" id="checkSettings">Check Connection</button>
	{!! Form::submit('Save', ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}
</div>

@section('footer')
	@parent
	<script>
		$('#checkSettings').on('click', function(e){
			e.preventDefault();

			var formData = {
                host     : $('input[name=host]').val(),
                port    : $('input[name=port]').val(),
                username : $('input[name=username]').val(),
                password  : $('input[name=password]').val(),
                encryption: $('input[name=encryption]').val()
			};

			$.ajax({
        		url: '/manage/checkMailSettings',
        		type: 'POST',        
        		beforeSend: function (xhr) {
        			var token = $('meta[name="csrf_token"]').attr('content');
        			if (token) {
             			 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
		            }
		        },
		        data: formData,
		        success: function (data) {
                        alert(data.success);
                },
                error: function(xhr, ajaxOptions, thrownError){
                		alert(xhr.statusText);
                }
	        })
		});
	</script>
@endsection