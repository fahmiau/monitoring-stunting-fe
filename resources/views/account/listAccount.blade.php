@extends('app')
@section('title','List Account')
@section('container')
@include('partials.titlePage',['title' => 'Daftar Akun Ibu'])
  {{-- <div class="w-2/3 ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl"> --}}
    <a href="{{ url('/add-new') }}" class="max-w-min inline-block">
      <div class="ml-8 mb-5 flex max-w-min bg-white rounded-xl hover:bg-gray-600 hover:text-white">
        <div class="p-2 border border-gray-600 rounded-l-xl">+</div>
        <div class="p-2 border border-gray-600 rounded-r-xl w-24">Add New</div>
      </div>
    </a>
    <div class="ml-8 ">

      <table class="border-collapse border bg-white w-3/4">
        <thead>
          <tr class="bg-blue-100">
            <th class="px-4 py-1 border  w-1/12">No</th>
            <th class="px-4 py-1 border  w-1/4">Nama Ibu</th>
            <th class="px-4 py-1 border  w-1/4">Nama Anak</th>
            <th class="px-4 py-1 border  w-1/2">Alamat</th>
            <th class="px-4 py-1 border  w-1/2">Action</th>
            
          </tr>
        </thead>
        <tbody>
          @foreach ($mothers as $mother)
              
          <tr class="hover:bg-blue-50">
            <td class="border px-4 py-1">{{ $loop->iteration }}</td>
            <td class="border px-4 py-1">{{ $mother->nama }}</td>
            <td class="border px-4 py-1">
              @foreach ($mother->childrens as $children)
                <div>
                  <a class="underline hover:no-underline" href="{{ url('/detail-anak/'.$children->id) }}">{{ $children->nama}}</a>
                </div>
              @endforeach
            <td class="border px-4 py-1">{{ $mother->alamat }}</td>
            <td class="border px-4 py-1 text-red-600"><a href="">Edit</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- </div> --}}
@endsection