@extends('app')

@section('content')

	<div class="row main-content">
		<div class="panel panel-default">
			<div class="panel-heading">Edit: {!! $page->title !!}</div>

			{!! Form::model( $page, [ 'route' => ['page.update', $page->slug], 'method' => 'PUT', 'id' => 'article_form']) !!}
				<div class="panel-body">

					@include('pages.partials.pageForm', ['submitButtonText' => 'Update Page'])

				
					{!! Form::close() !!}

					{!! Form::open(['route' => ['page.delete', $page->slug], 'method' => 'DELETE', 'onsubmit' => 'return ConfirmDelete()']) !!}

						{!! Form::hidden('slug', $page->slug) !!}
						{!! Form::button('Delete Page <i class="fa fa-trash-o"></i>', ['onsubmit' => 'return ConfirmDelete()', 'type' => 'submit', 'class' => 'btn btn-danger pull-right', 'id' => 'deleteBtn']) !!}

					{!! Form::close() !!}

				</div>
		</div>
	</div>

@stop
