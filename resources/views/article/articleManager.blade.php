@extends('app')
@section('title','Article Manager')
@section('container')
  @include('partials.titlePage',['title' => 'Article Manager'])

  <a class="inline-block" href="{{ url('/article/create') }}">
    <div class="cursor-pointer ml-8 mb-5 flex bg-white max-w-min rounded-xl hover:bg-gray-600 hover:text-white">
      <div class="p-2 border border-gray-600 rounded-l-xl">+</div>
      <div class="p-2 border border-gray-600 rounded-r-xl w-24">Add New</div>
    </div>
  </a>
  {{-- <div class="w-2/3 ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl"> --}}
    
    <div class="ml-8 ">

      <table class="border-collapse border bg-white w-3/4">
        <thead>
          <tr class="bg-blue-100">
            <th class="px-4 py-1 border  w-1/12">No</th>
            <th class="px-4 py-1 border  w-1/4">Judul</th>
            <th class="px-4 py-1 border  w-1/4">Tanggal Publish</th>
            <th class="px-4 py-1 border  w-1/2">Status</th>
            <th class="px-4 py-1 border  w-1/2">Penulis</th>
            <th class="px-4 py-1 border  w-1/2">Views</th>
            <th class="px-4 py-1 border  w-1/2">Likes</th>
            <th class="px-4 py-1 border  w-1/2">Action</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($articles as $article)
            <tr class="hover:bg-blue-50">
              <td class="border px-4 py-1">{{ $loop->iteration }}</td>
              <td class="border px-4 py-1"><a href="{{ url('/article/published/'.$article->slug) }}" target="_blank">{{ $article->title }}</a></td>
              <td class="border px-4 py-1">{{ $article->publish_date }}</td>
              <td class="border px-4 py-1">{{ ($article->published == 0) ? 'Draft' : 'Published' }}</td>
              <td class="border px-4 py-1">{{ $article->author }}</td>
              <td class="border px-4 py-1">{{ $article->views->views }}</td>
              <td class="border px-4 py-1">{{ $article->likes->likes }}</td>
              <td class="border px-4 py-1"><a class="underline hover:no-underline" href="{{ url('/article/edit/'.$article->slug) }}">EDIT</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  {{-- </div> --}}
@endsection