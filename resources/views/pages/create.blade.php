@extends('app')

@section('content')

	<div class="row main-content">
		<div class="panel panel-default">
			<div class="panel-heading">Create a new page</div>

			{!! Form::open([ 'route' => 'page.store', 'id' => 'article_form']) !!}
				<div class="panel-body">

					@include('pages.partials.pageForm', ['submitButtonText' => 'Add Page'])

				</div>
			{!! Form::close() !!}

		</div>
	</div>

@stop
