@extends('app')
@section('title','List Nakes')
@section('container')
  <div class="pt-3 bg-secondary">
    <div class="rounded-tl-3xl bg-primary p-4 text-2xl border-t-8 border-secondary">
      <div class="flex max-w-min">
        <a href="{{ url('/account/mother') }}" class="p-2 border-b-secondary hover:border-b-4 font-bold px-8 text-center text-secondary">Ibu</a>
        <a href="{{ url('/account/nakes') }}" class="p-2 rounded-t-lg bg-secondary border-b-secondary border-b-4 font-bold px-8 text-center text-gray-100">Nakes</a>
        <a href="{{ url('/account/kader') }}" class="p-2 border-b-secondary hover:border-b-4 font-bold px-8 text-center text-secondary">Kader</a>
      </div>
    </div>
  </div>
    <a href="{{ url('/add-new') }}" class="ml-8 mb-5 max-w-min inline-block">
      <div class="flex max-w-min bg-white rounded-xl hover:bg-gray-600 hover:text-white">
        <div class="p-2 border border-gray-600 rounded-l-xl">+</div>
        <div class="p-2 border border-gray-600 rounded-r-xl w-24">Add New</div>
      </div>
    </a>
    <div class="ml-8 ">
      {{-- Select Form --}}
      @include('partials.selectFormAccounts',[
        'data_daerah' => $data_daerah, 
        'provinsis' => $provinsis,
        'kota_kabupatens' => $kota_kabupatens,
        'kelurahans' => $kelurahans,
        'kecamatans' => $kecamatans,])

      <table class="border-collapse border bg-white w-11/12">
        <thead>
          <tr class="bg-blue-100">
            <th class="px-4 py-1 border  w-12">No</th>
            <th class="px-4 py-1 border  w-3/12">Nama Nakes</th>
            <th class="px-4 py-1 border  w-2/12">No Hp Pribadi</th>
            <th class="px-4 py-1 border  w-2/12">Role</th>
            <th class="px-4 py-1 border  w-1/12">Kecamatan</th>
            <th class="px-4 py-1 border  w-1/12">Kelurahan</th>
            <th class="px-4 py-1 border  w-2/12">Unit Kerja</th>
            <th class="px-4 py-1 border  w-1/12">Action</th>
            
          </tr>
        </thead>
        <tbody id="nakes-table">
          @foreach ($nakes as $n)
            <tr class="hover:bg-blue-50">
              <td class="border px-4 py-1">{{ $loop->iteration }}</td>
              <td class="border px-4 py-1">{{ $n->name }}</td>
              <td class="border px-4 py-1">{{ $n->nomor_telepon }}</td>
              <td class="border px-4 py-1">{{ $n->category }}</td>
              <td class="border px-4 py-1">{{ $n->kecamatan }}</td>
              <td class="border px-4 py-1">{{ $n->kelurahan }}</td>
              <td class="border px-4 py-1">{{ $n->tempat_kerja }}</td>
              <td class="border px-4 py-1 w-32">
                <a
                  class="inline-block text-center font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300"
                  href="{{ url('/account/nakes/'.$n->id) }}">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <button 
                  onclick="deleteAccount({{ $n->id }})"
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
<script src="{{ asset('js/listAccount.js') }}"></script>
<script src="{{ asset('js/selectForm.js') }}"></script>
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
        fetch(local_url+'/account/nakes/delete/'+id)
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