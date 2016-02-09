<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['id' => 'title', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('title') }}</small>
</div>

<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['id' => 'article_body', 'class' => 'form-control']) !!}
    <small class="text-danger">{{ $errors->first('body') }}</small>
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="show_sidebar">
        	{!! Form::hidden('show_sidebar', 0) !!}
            {!! Form::checkbox('show_sidebar',true , isset($page) ? $page->show_sidebar : true, ['id' => 'show_sidebar']) !!} <b>Show Sidebar on Page?</b>
        </label>
    </div>
    <small class="text-danger">{{ $errors->first('show_sidebar') }}</small>
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="show_menu">
            {!! Form::hidden('show_menu', 0) !!}
            {!! Form::checkbox('show_menu', true, isset($page) ? $page->show_menu : true, ['id' => 'show_menu']) !!} <b>Show in Main Nav Bar?</b>
        </label>
    </div>
    <small class="text-danger">{{ $errors->first('show_menu') }}</small>
</div>

<div class="form-group">
    <div class="checkbox">
        <label for="show_contact_form">
            {!! Form::hidden('show_contact_form', 0) !!}
            {!! Form::checkbox('show_contact_form', true, isset($page) ? $page->show_contact_form : true, ['id' => 'show_contact_form']) !!} <b>Show Basic Contact Form on Top of Page?</b>
        </label>
    </div>
    <small class="text-danger">{{ $errors->first('show_contact_form') }}</small>
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['id' => 'slug', 'class' => 'form-control', 'required' => 'required']) !!}
    <small class="text-danger">{{ $errors->first('slug') }}</small>
</div>

@if(isset($page))
	{!! Form::hidden('id', $page->id) !!}
@endif

{!! Form::submit($submitButtonText, ['class' => 'btn btn-default pull-right', 'id' => 'submitBtn']) !!}


@section('footer')
    <script>
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
                        //updateImageDisplay();
                    } );

                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = document.getElementById( elementId );
                        output.value = evt.data.resizedUrl;
                    } );
                }
            } );
        }

        //function updateImageDisplay(){
            //$('#featured-image').attr('src', $('#featured_image').val());
        //}
    </script>
@endsection