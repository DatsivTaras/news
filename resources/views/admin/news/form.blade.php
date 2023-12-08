
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script src="https://cdn.tiny.cloud/1/xpu0y53v3k0hf6axlu37gm26g4ixqyidve0pfclq15j6nval/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.tiny.cloud/1/y26a029ydyylmsnf30o7fgdvjj6kudbynz7ukktszbvev5r6/tinymce/6/plugins.min.js" referrerpolicy="origin"></script>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8">
                <div class="mb-3">
                    {{ Form::label(__('main.title')) }}
                    {{ Form::text('title', $news->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => __('main.title') ]) }}
                    {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    {{ Form::label( __('main.captionToPhoto')) }}
                    {{ Form::text('subtitle', $news->subtitle, ['class' => 'form-control' . ($errors->has('subtitle') ? ' is-invalid' : ''), 'placeholder' =>  __('main.captionToPhoto')]) }}
                    {!! $errors->first('subtitle', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    {{ Form::label(__('main.miniDescription')) }}
                    {{ Form::textarea('mini_description', $news->mini_description, ['class' => 'form-control' . ($errors->has('mini_description') ? ' is-invalid' : ''), 'rows' => '3', 'placeholder' => __('main.miniDescription') ]) }}
                    {!! $errors->first('mini_description', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    {{ Form::label(__('main.description')) }}
                    {{ Form::textarea('description', $news->description, ['class' => 'description form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => __('main.description') ]) }}
                    {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    {{ Form::text('tags', $tags, ['class' => 'form-control' . ($errors->has('tags') ? 'is-invalid' : ''), 'placeholder' => 'Тег...', 'data-role' => 'tagsinput']) }}
                    {!! $errors->first('tags', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    {{ Form::label('text',  __('main.image'), ['class' => 'form-label']) }}
                    {{ Form::file('image', [
                        'accept' => "image/*",
                        'class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : ''),
                        'onchange'=> "getImagePreview(event)",
                        "public/image/planes/Fh2pmleVODSftbdH0gctY01sr6FH4iQHUkDXxDCd.png",
                        "id" => "selectImage"]) }}
                    {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
                    <img id="preview" width="50%" src="{{ Storage::url($image) }}" alt="/" class="mt-3" style="{{$image ? '' : 'display:none'}}"/>
                </div>

                <div class="mb-3">
                    {{ Form::label( __('main.category')) }}
                    {{ Form::select('category_id', $categories, $news->category, ['class' => 'form-select' . ($errors->has('category_id') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    {{ Form::label( __('main.author')) }}
                    {{ Form::select('author_id', $authors, $news->author, ['class' => 'form-select' . ($errors->has('author_id') ? ' is-invalid' : '')]) }}
                    {!! $errors->first('author_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        {{ Form::label(__('main.publish')) }}
                        {{ Form::radio('type_publication', 1, $news->type_publication == 1 ? true : false, ['checked' => 'checked']) }}
                        {!! $errors->first('type_publication', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-check form-check-inline">
                        {{ Form::label(__('main.draft')) }}
                        {{ Form::radio('type_publication', 2, $news->type_publication == 2 ? true : false) }}
                        {!! $errors->first('type_publication', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="form-check form-check-inline">
                    {{ Form::label(__('main.simpleNews')) }}
                    {{ Form::radio('type', 1, $news->type == 1 ? true : false, ['checked' => 'checked']) }}
                    {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-check form-check-inline">
                    {{ Form::label(__('main.importantNews')) }}
                    {{ Form::radio('type', 2, $news->type == 2 ? true : false) }}
                    {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
                </div><br><br>
                <div class="mb-3">
                    {{ Form::label(__('main.dateOfPublication')) }}
                    {{ Form::dateTimelocal('date_of_publication', date('Y-m-d H:i', strtotime($news->date_of_publication ? date('Y-m-d H:i', strtotime($news->date_of_publication)) : now())), ['class' => 'form-control' . ($errors->has('date_of_publication') ? ' is-invalid' : ''), 'placeholder' => 'Date Of Publication']) }}
                    {!! $errors->first('date_of_publication', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>


        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Зберегти') }}</button>
    </div>
</div>

<script>
    selectImage.onchange = evt => {
        preview = document.getElementById('preview');
        preview.style.display = 'block';
        const [file] = selectImage.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }

    tinymce.init({
        selector: 'textarea.description',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export ' +
            'formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes' +
            ' mergetags autocorrect typography inlinecss code preview',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough ' +
            '| link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight ' +
            '| checklist numlist bullist indent outdent | emoticons charmap | removeformat pageembed code preview',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],

        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
          URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
          images_upload_url: 'postAcceptor.php',
          here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
              Note: In modern browsers input[type="file"] is functional without
              even adding it to the DOM, but that might not be the case in some older
              or quirky browsers like IE, so you might want to add it to the DOM
              just in case, and visually hide it. And do not forget do remove it
              once you do not need it anymore.
            */

            input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function () {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        extended_valid_elements : "script[charset|defer|language|src|type]"
    });
</script>
