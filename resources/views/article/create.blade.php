@extends('app')

@section('container')
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#body',
      image_class_list: [
        {title: 'img-responsive', value: 'img-responsive'},
        ],
      height : 500,
      setup: function (editor) {
        editor.on('init change', function () {
          editor.save();
        });
      },
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

      image_title: true,
      automatic_uploads: true,
      images_upload_url: '/article/image-upload',
      file_picker_types: 'image',
      convert_urls: false,
      file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
          var file = this.files[0];

          var reader = new FileReader();
          reader.readAsDataURL(file);
          reader.onload = function () {
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            cb(blobInfo.blobUri(), { title: file.name });
          };
        };
        input.click();
      }
    });
  </script>
  <h2 class="text-2xl font-medium ml-8 my-8">Articel Editor</h2>
  <div class="ml-8">

    <form action="{{ url('/article/store') }}" method="POST">
      @csrf
      <label class="block font-medium" for="title">Judul Artikel</label>
      <input class="w-1/2" type="text" name="title">

      <label class="block mt-8 font-medium" for="body">Isi</label>
      <div class="w-11/12 min-h-1/2">
        <textarea name="body" id="body">Isi Artikel</textarea>
      </div>

      <label class="block font-medium mt-4" for="penulis">Penulis</label>
      <input class="w-1/4" type="text" name="author">

      <label class="block font-medium mt-4" for="published">Publish</label>
      <input class="" type="radio" name="published" id="published" value="1">
      <span>Iya</span>
      <input class="" type="radio" name="published" id="published" value="0">
      <span>Tidak</span>

      <div class="mt-4 bg-[#06CA51] py-2 px-4 max-w-min rounded-md">
        <button class="font-medium" type="submit">Simpan</button>
      </div>
    </form>
  
  </div>
@endsection