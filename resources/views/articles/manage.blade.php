@extends('app')

@section('content')
	<div class="row main-content">
		<h3 class="text-center">Blog Posts</h3>
		<table id="blogPosts" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
	            <tr>
	                <th>Title</th>
	                <th>Subtitle</th>
	                <th>Status</th>
	                <th>Published At</th>
	                <th>Created At</th>
	                <th>Edit</th>
	            </tr>
        	</thead>
        	<tbody>
			 @foreach ($articles as $article)
			 <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->subtitle }}</td>
                <td>{{ $article->status ? 'Published' : 'Draft' }}</td>
                <td>{{ date('F d, Y', strtotime($article->published_at)) }}</td>
                <td>{{ date('F d, Y', strtotime($article->created_at)) }}</td>
                <td><a class="btn" href="{{ route('blog.edit', ['slug' => $article->slug]) }}"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
            </tr>
			 @endforeach
			</tbody>
		 </table>
		 <a class="btn btn-default" href="{{ url('/blog/create') }}"><i class="fa fa-pencil-square-o fa-lg">Create New Blog Post</i></a>
	</div>
	<hr />
	<div class="row main-content">
		<h3 class="text-center">Pages</h3>
		<table id="pages" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
	            <tr>
	                <th>Title</th>
	                <th>Body</th>
	                <th>Sidebar</th>
	                <th>Menu</th>
	                <th>Edit</th>
	            </tr>
        	</thead>
        	<tbody>
			 @foreach ($pages as $page)
			 <tr>
                <td>{{ $page->title }}</td>
                <td>{!! substr($page->body, 0, 100) !!}</td>
                <td>{{ $page->show_sidebar ? 'show' : '' }}</td>
                <td>{{ $page->show_menu ? 'show' : '' }}</td>
                <td><a class="btn" href="{{ route('page.edit', ['id' => $page->slug]) }}"><i class="fa fa-pencil-square-o fa-lg"></i></a></td>
            </tr>
			 @endforeach
			</tbody>
		 </table>
		 <a class="btn btn-default" href="{{ url('/page/create') }}"><i class="fa fa-pencil-square-o fa-lg">Create New Page</i></a>
	</div>
	<hr />
	{!! Form::model($blog_info, [ 'route' => 'blog.manage.store', 'id' => 'manage_form']) !!}
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Category Menu</div>
				<div class="panel-body">
					<div class="form-inline">
	                    <label for="auto_category_menu">Would You Like To Auto Add Categories To Menu?</label>                
	                    {!! Form::select('auto_category_menu', ['No', 'Yes'], null, ['class' => 'form-control pull-right']) !!}
	                </div>
					<div class="col-md-3">
						@foreach($categories as $category)
							<div class="form-group">
								<div class="checkbox">
									<label><input type="checkbox" {{ $category->add_menu ? 'checked' : '' }} id="menuId{{ $category->id }}">{{ $category->name }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<div class="col-md-3">
					</div>
				</div>
			</div>
	</div>
	<hr />
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Blog Settings</div>

				<div class="panel-body">

					<div class="form-group">
					    {!! Form::label('blog_name', 'Blog Name:') !!}
					    {!! Form::text('blog_name', null, ['class' => 'form-control']) !!}
					    <small class="text-danger">{{ $errors->first('blog_name') }}</small>
					</div>
					<div class="form-group">
					    {!! Form::label('tagline', 'Tag Line:') !!}
					    {!! Form::text('tagline', null, ['class' => 'form-control']) !!}
					    <small class="text-danger">{{ $errors->first('tagline') }}</small>
					</div>
					<div class="form-group">
					    {!! Form::label('author', 'Author:') !!}
					    {!! Form::text('author', null, ['class' => 'form-control']) !!}
					    <small class="text-danger">{{ $errors->first('author') }}</small>
					</div>
					<div class="form-group">
					    {!! Form::label('email', 'Email:') !!}
					    {!! Form::text('email', null, ['class' => 'form-control']) !!}
					    <small class="text-danger">{{ $errors->first('email') }}</small>
					</div>
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
					<div class="form-group">
					    {!! Form::label('featured_image', 'Featured Image:') !!}
					    <div class="input-group">
					        {!! Form::text('featured_image', null, ['id' => 'featured_image', 'class' => 'form-control', 'readonly' => 'true']) !!}
					        <span class="input-group-btn">
					            <a class="btn btn-default" id="ckfinder-popup">Browse Server</a>
					        </span>
					    </div>
					    <small class="text-danger">{{ $errors->first('body') }}</small>

					    <img src="" id="featured-image">
					</div>
					{!! Form::submit('Update', ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}
				</div>
		</div>
	</div>
	{!! Form::close() !!}

	@include('partials/footer')
	
@stop

@section('footer')
	<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#blogPosts').DataTable();

			$('#pages').DataTable();

			$('#featured-image').attr('src', $('#featured_image').val());

	        $("#ckfinder-popup").click(function(){
	            selectFIleWithCKFinder('featured_image');
	        });

	        $('input[id^="menuId"]').on('click', function() {

	        	var id = this.id.match(/\d+/);
	        	var checked = $('#menuId' + id).is(':checked') ? '1' : '0';

	        	$.ajax({
	        		url: 'updateCategory',
	        		type: 'POST',        
	        		beforeSend: function (xhr) {
            			var token = $('meta[name="csrf_token"]').attr('content');
            			if (token) {
                 			 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			            }
			        },
			        data: { id , checked }
	        	})
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
@stop