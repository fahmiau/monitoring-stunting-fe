@extends('app')
@section('title','Edit Article')
@section('container')
  <script src="https://cdn.tiny.cloud/1/qy9fluneitjt64pe35btqsaauaxl28p8vud57xq7x7pyst0m/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
      plugins: 'image lists',
      content_css: '/css/tinycss.css?' + new Date().getTime(),
      body_class: 'px-8 py-4',
      formats: {
        // Changes the default format for the bold button to produce a span with a bold class
        bold: { inline: 'span', classes: 'font-bold' },
        p : {block: 'p', classes: 'indent-8 my-4'},
        indent : {block: 'p', classes: 'indent-8 my-4'},
        h1: { block: 'h1', classes: 'font-bold text-3xl'},
        h2: { block: 'h2', classes: 'font-bold text-2xl'},
        h3: { block: 'h3', classes: 'font-bold text-xl'},
        alignleft: { block: 'p', classes: 'text-left'},
        alignright: { block: 'p', classes: 'text-right'},
        alignjustify: { block: 'p', classes: 'text-justify'},
        aligncenter: { block: 'p', classes: 'text-center'},
        italic: { inline: 'span', classes: 'italic'},
        underline: { inline: 'span', classes: 'underline'},
        strikethrough: { inline: 'span', classes: 'line-through'},
      },
      // plugins: [
      //   "advlist autolink lists link image charmap print preview anchor",
      //   "searchreplace visualblocks code fullscreen",
      //   "insertdatetime media table contextmenu paste imagetools"
      // ],
      toolbar: "undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

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
  @include('partials.titlePage',['title' => 'Article Editor'])
  <div class="ml-8">

    <form action="{{ url('/article/update/'.$article->slug) }}" method="POST" onsubmit="showLoading()">
      @csrf
      <label class="block font-medium" for="title">Judul Artikel</label>
      <input class="w-1/2" type="text" name="title" value="{{ $article->title }}">

      <input type="hidden" name="slug" value="{{ $article->slug }}">

      <label class="block mt-8 font-medium" for="body">Isi</label>
      <div class="w-11/12 min-h-1/2">
        <textarea id="body" name="body">{{ $article->body }}</textarea>
        {{-- {!! $article->body !!} --}}
      </div>
      <input type="hidden" name="image_url" id="image_url" value="">
      <input type="hidden" name="image_name" id="image_name" value="">
      <label class="block font-medium mt-4" for="penulis">Penulis</label>
      <input class="w-1/4" type="text" name="author" value="{{ $article->author }}">

      <label class="block font-medium mt-4" for="published">Publish</label>
      <input class="" type="radio" name="published" id="published" value="1" {{ $article->published == 1 ? 'checked' : '' }}>
      <span>Iya</span>
      <input class="" type="radio" name="published" id="published" value="0" {{ $article->published == 0 ? 'checked' : '' }}>
      <span>Tidak</span>
      <div class="mt-4 bg-[#06CA51] py-2 px-4 max-w-min rounded-md">
        <button class="font-medium" type="submit">Simpan</button>
        <div id="loading-spinner" class="hidden">
          <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
        </div>
      </div>
    </form>
  
  </div>
  <script defer>
    document.addEventListener('click',()=>{
      var img = tinyMCE.get('body').dom.select('img')[0]
      if (img) {
        document.getElementById('image_url').value = img.dataset.mceSrc
        document.getElementById('image_name').value = img.dataset.mceSrc.replace('/storage/article_images/','')
      }
    })
    function showLoading() {
      document.querySelector('button[type="submit"]').disabled = true;
      document.getElementById('loading-spinner').classList.remove('hidden');
    }
  </script>
@endsection