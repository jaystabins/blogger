@extends('install.installer')

@section('content')
<div class="row main-content">
	<div class="container-fluid" id="regInfoForm">
		<div class="row main-content">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Social Icons</div>
					<div class="panel-body">
						{!! Form::open([ 'url' => 'install/socialConnect', 'id' => 'install_social']) !!}
							@include('manage.partials.socialConnectForm');
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
