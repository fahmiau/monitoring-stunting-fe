@extends('app')

@section('container')
  <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
    <h2 class="text-2xl font-medium ml-8 mt-8 mb-2">Articel Manager</h2>


    <div class="cursor-pointer ml-8 mb-5 flex bg-white max-w-min rounded-xl hover:bg-gray-600 hover:text-white">
      <div class="p-2 border border-gray-600 rounded-l-xl">+</div>
      <div class="p-2 border border-gray-600 rounded-r-xl w-24">Add New</div>
    </div>
    {{-- <div class="w-2/3 ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl"> --}}
      
      <div class="ml-8 ">

        <table class="border-collapse border bg-white w-3/4">
          <thead>
            <tr class="bg-blue-100">
              <th class="px-4 py-1 border  w-1/12">No</th>
              <th class="px-4 py-1 border  w-1/4">Nama</th>
              <th class="px-4 py-1 border  w-1/4">Nama Anak</th>
              <th class="px-4 py-1 border  w-1/2">Alamat</th>
              
            </tr>
          </thead>
          <tbody>
            @for ($i = 0; $i < 10; $i++)
            <tr class="hover:bg-blue-50">
              <td class="border px-4 py-1">X</td>
              <td class="border px-4 py-1">X</td>
              <td class="border px-4 py-1">X</td>
              <td class="border px-4 py-1">X</td>
            </tr>
            @endfor
          </tbody>
        </table>
      </div>
    {{-- </div> --}}
  </div>
@endsection