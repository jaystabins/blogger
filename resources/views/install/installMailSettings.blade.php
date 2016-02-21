@extends('install.installer')

@section('content')
<div class="container-fluid">
	<div class="row main-content">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Mail Settings</div>
				<div class="panel-body">
					<div class="text-center">
						<p>Set up mail settings here. If no mail settings are set, you will not be able to send passowrd resets or use the built in contact form.</p>
					</div>
					{!! Form::open([ 'url' => 'install/mailSettings', 'id' => 'install_mail']) !!}
						@include('manage.partials.mailSettingsForm')
					{!! Form::close() !!}
				<a href="/blog/manage" class="btn btn-default pull-right">Skip Mail Settings</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer')

@endsection
