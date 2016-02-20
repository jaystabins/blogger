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

<div class="form-group">
    <div class="checkbox">
        <label><input type="checkbox" {{ (bool)$info->auto_category_menu ? 'checked' : '' }} id="auto_category_menu" name="auto_category_menu">Add To Menu</label>
    </div>
</div>

<div class="form-group">
    {!! Form::label('tag_list', 'Tags:') !!}
    {!! Form::select('tag_list[]', $tag_list, (isset($article) ? $article->tags->lists('id')->toArray() : 'tag_list'), ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
    <small class="text-danger">{{ $errors->first('tag_list') }}</small>
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="show_sharebar">
            {!! Form::hidden('show_sharebar', 0) !!}
            {!! Form::checkbox('show_sharebar', true, isset($article) ? $article->show_sharebar : true, ['id' => 'show_sharebar']) !!} <b>Show Sharebar</b>
        </label>
    </div>
    <small class="text-danger">{{ $errors->first('status') }}</small>
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

    <img src="" id="featured-image" class="img-responsive">
</div>

@if(isset($article))
	{!! Form::hidden('id', $article->id) !!}
@endif

{!! Form::submit($submitButtonText, ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}


@section('footer')
    <script>
        if($('#category_list').val() != null)
            getCategoryMenuCheck();

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

        $('button#deleteBtn').on('click', function(){
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this post!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $("#frmDelete").submit();
                } else {
                    swal("Cancelled", "Your post has not been deleted", "error");
                }
            });
        });

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

        $('#category_list').on('change', function(e){
            getCategoryMenuCheck();
        });

        function getCategoryMenuCheck(){
            var option, select = $('#category_list');
            option = $('#category_list option:selected').text();
            id = $('#category_list option:selected').val();

            $('#category_list option').each(function(){
                if(this.text == option){
                    $.ajax({
                        url: '/category/checkCategoryMenu',
                        type: 'POST',        
                        beforeSend: function (xhr) {
                            var token = $('meta[name="csrf_token"]').attr('content');
                            if (token) {
                                 return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            }
                        },
                        data: { id , option },
                        success: function (data) {
                            console.log(data);
                            if(data == '1' || '{{ (bool)$info->auto_category_menu }}')
                                $('#auto_category_menu').prop('checked', true);
                            else
                                $('#auto_category_menu').prop('checked', false);
                        }
                    })
                }
            }) 
        }
    </script>
@endsection