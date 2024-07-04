@extends('app')
@section('title','Article Manager')
@section('container')
  @include('partials.titlePage',['title' => 'Article Manager'])

  <a class="ml-8 mb-5 inline-block" href="{{ url('/article/create') }}">
    <div class="flex bg-white max-w-min rounded-xl hover:bg-gray-600 hover:text-white">
      <div class="p-2 border border-gray-600 rounded-l-xl">+</div>
      <div class="p-2 border border-gray-600 rounded-r-xl w-24">Add New</div>
    </div>
  </a>
  {{-- <div class="w-2/3 ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl"> --}}
    
    <div class="ml-8">

      <table class="border-collapse border bg-white w-11/12">
        <thead>
          <tr class="bg-blue-100">
            <th class="px-4 py-1 border w-12">No</th>
            <th class="px-4 py-1 border w-1/6">Judul</th>
            <th class="px-4 py-1 border w-1/6">Tanggal Publish</th>
            <th class="px-4 py-1 border w-2/12">Status</th>
            <th class="px-4 py-1 border w-1/6">Penulis</th>
            <th class="px-4 py-1 border w-1/12">Views</th>
            <th class="px-4 py-1 border w-1/12">Likes</th>
            <th class="px-4 py-1 border w-2/12">Action</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($articles as $article)
            <tr class="hover:bg-blue-50">
              <td class="border px-4 py-1">{{ $loop->iteration }}</td>
              <td class="border px-4 py-1"><a href="{{ url('/article/published/'.$article->slug) }}" target="_blank">{{ $article->title }}</a></td>
              <td class="text-center border px-4 py-1">{{ $article->publish_date }}</td>
              <td class="text-center border px-4 py-1">{{ ($article->published == 0) ? 'Draft' : 'Published' }}</td>
              <td class="border px-4 py-1">{{ $article->author }}</td>
              <td class="text-center border px-4 py-1">{{ $article->views->views }}</td>
              <td class="text-center border px-4 py-1">{{ count($article->likes) }}</td>
              <td class="border px-4 py-1">
                {{-- <a class="block underline hover:no-underline text-blue-600 hover:text-black" href=""><i class="fas fa-edit"></i>EDIT</a>
                <a class="block underline hover:no-underline text-red-600 hover:text-black" href=""><i class="fas fa-trash-alt"></i>DELETE</a> --}}
                <a
                  class="inline-block text-center w-2/3 font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300"
                  href="{{ url('/article/edit/'.$article->slug) }}">
                  EDIT
                </a>
                <button 
                  onclick="deleteArticle('{{ $article->slug }}')"
                  class="bg-red-600 py-2 px-2 border-secondary border-2 rounded-md text-white hover:text-black" 
                  >
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  {{-- </div> --}}
@endsection
<script>
  const local_url = process.env.APP_URL;
  function deleteArticle(slug) {
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan !',
      text: 'Yakin akan menghapus?',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus data',
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(local_url'/article/delete/'+slug)
          .then(response => response.text())
          .then((res) => {
            if (res == 'success') {
              Swal.fire('Data Berhasil Dihapus!','','success')
                .then(()=>{
                  location.reload()
                })
            }
          })
      }
    })
  }
</script>