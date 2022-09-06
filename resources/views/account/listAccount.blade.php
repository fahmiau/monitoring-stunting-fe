@extends('app')
@section('title','List Account')
@section('container')
@include('partials.titlePage',['title' => 'Daftar Akun Ibu'])
  {{-- <div class="w-2/3 ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl"> --}}
    <a href="{{ url('/add-new') }}" class="ml-8 mb-5 max-w-min inline-block">
      <div class="flex max-w-min bg-white rounded-xl hover:bg-gray-600 hover:text-white">
        <div class="p-2 border border-gray-600 rounded-l-xl">+</div>
        <div class="p-2 border border-gray-600 rounded-r-xl w-24">Add New</div>
      </div>
    </a>
    <div class="ml-8 ">

      <table class="border-collapse border bg-white w-10/12">
        <thead>
          <tr class="bg-blue-100">
            <th class="px-4 py-1 border  w-12">No</th>
            <th class="px-4 py-1 border  w-3/12">Nama Ibu</th>
            <th class="px-4 py-1 border  w-3/12">Nama Anak</th>
            <th class="px-4 py-1 border  w-3/12">Alamat</th>
            <th class="px-4 py-1 border  w-2/12">Action</th>
            
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
                    <a class="underline hover:no-underline" href="{{ url('/children/detail/'.$children->id) }}">{{ $children->nama}}</a>
                  </div>
                @endforeach
              </td>
              <td class="border px-4 py-1">{{ $mother->alamat }}</td>
              <td class="border px-4 py-1 w-32">
                <a
                  class="inline-block text-center w-2/3 font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300"
                  href="{{ url('/account/mother/'.$mother->id) }}">
                  EDIT
                </a>
                <button 
                  onclick="deleteAccount({{ $mother->id }})"
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
  function deleteAccount(id) {
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
        fetch('http://167.172.85.4/account/mother/delete/'+id)
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