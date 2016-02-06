<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('title') }}</small>
</div>

<div class="form-group">
    {!! Form::label('subtitle', 'Subtitle:') !!}
    {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
    <small class="text-danger">{{ $errors->first('subtitle') }}</small>
</div>

<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['id' => 'article_body', 'class' => 'form-control']) !!}
    <small class="text-danger">{{ $errors->first('body') }}</small>
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="status">
        	{!! Form::hidden('status', 0) !!}
            {!! Form::checkbox('status', true, true, ['id' => 'status']) !!} <b>Published</b>
        </label>
    </div>
    <small class="text-danger">{{ $errors->first('status') }}</small>
</div>

<div class="form-group">
    {!! Form::label('published_at', 'Publish Date:') !!}
    {!! Form::date('published_at', (isset($article) ? $article->published_at->format('Y-m-d') : Carbon\Carbon::now()), ['class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('published_at') }}</small>
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('slug') }}</small>
</div>

<div class="form-group">
    {!! Form::label('catagory_list', 'Category:') !!}
    {!! Form::select('category_list[]', $category_list, (isset($article) ? $article->categories->lists('id')->toArray() : 'category_list'), ['id' => 'category_list', 'class' => 'form-control', 'multiple']) !!}
    <small class="text-danger">{{ $errors->first('category_list') }}</small>
</div>

<div class="form-group" style="display:none;" id="hiddenDiv">
    <div class="checkbox">
        <label for="add_menu">
            {!! Form::hidden('add_menu', 0) !!}
            {!! Form::checkbox('add_menu', false, false, ['id' => 'add_menu']) !!} <b>Add Menu</b>
        </label>
    </div>
    <small class="text-danger">{{ $errors->first('add_menu') }}</small>
</div>

<div class="form-group">
    {!! Form::label('tag_list', 'Tags:') !!}
    {!! Form::select('tag_list[]', $tag_list, (isset($article) ? $article->tags->lists('id')->toArray() : 'tag_list'), ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
    <small class="text-danger">{{ $errors->first('tag_list') }}</small>
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

@if(isset($article))
	{!! Form::hidden('id', $article->id) !!}
@endif

{!! Form::submit($submitButtonText, ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}


@section('footer')
    <script>
        $('#tag_list').select2({
            placeholder: 'Choose or enter tag(s)',
            tags: true
        });

        $('#category_list').select2({
            placeholder: 'Choose or enter Category',
            tags: true,
            maximumSelectionLength: 1
        });

        $(function() {
            $('#title').change(function() {
                var slug = $(this).val()
                    slug = slug.toLowerCase();
                    slug = slug.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
                    slug = slug.replace(/\s+/g, "-");
            $('#slug').val(slug);
            });

            var imgPath = $('#featured_image').val();
            $('#featured-image').attr('src', imgPath);
        });

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

        CKEDITOR.replace('body' ,{
            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        });

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
    </script>
@endsection