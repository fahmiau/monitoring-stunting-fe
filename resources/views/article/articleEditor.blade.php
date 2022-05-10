@extends('app')

@section('container')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#article-editor'
  });
</script>
<div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
  <h2 class="text-2xl font-medium ml-8 my-8">Articel Editor</h2>
  <div class="ml-8">

    <form action="">
      @csrf
      <label class="block font-medium" for="title">Judul Artikel</label>
      <input type="text" name="title">

      <label class="block mt-8 font-medium" for="isi">Isi</label>
      <div class="w-11/12">
        <textarea id="article-editor">Isi Artikel</textarea>
      </div>
    </form>
  
  </div>
</div>
@endsection