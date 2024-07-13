@extends('app')
@section('title','List Kader')
@section('container')
  <div class="pt-3 bg-secondary">
    <div class="rounded-tl-3xl bg-primary p-4 text-2xl border-t-8 border-secondary">
      <div class="flex max-w-min">
        <a href="{{ url('/account/mother') }}" class="p-2 border-b-secondary hover:border-b-4 font-bold px-8 text-center text-secondary">Ibu</a>
        <a href="{{ url('/account/nakes') }}" class="p-2 border-b-secondary hover:border-b-4 font-bold px-8 text-center text-secondary">Nakes</a>
        <a href="{{ url('/account/kader') }}" class="p-2 rounded-t-lg bg-secondary border-b-secondary border-b-4 font-bold px-8 text-center text-gray-100">Kader</a>
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
            <th class="px-4 py-1 border w-12">No</th>
            <th class="px-4 py-1 border w-3/12">Nama Kader</th>
            <th class="px-4 py-1 border w-2/12">No Hp Pribadi</th>
            <th class="px-4 py-1 border w-min-3/12">Alamat</th>
            <th class="px-4 py-1 border w-2/12">Kecamatan</th>
            <th class="px-4 py-1 border w-2/12">Kelurahan</th>
            <th class="px-4 py-1 border w-1/12">Action</th>
            
          </tr>
        </thead>
        <tbody id="kader-table">
          @foreach ($kaders as $k)
            <tr class="hover:bg-blue-50">
              <td class="border px-4 py-1">{{ $loop->iteration }}</td>
              <td class="border px-4 py-1">{{ $k->name }}</td>
              <td class="border px-4 py-1">{{ $k->nomor_telepon }}</td>
              <td class="border px-4 py-1">{{ $k->alamat }}</td>
              <td class="border px-4 py-1">{{ $k->kecamatan }}</td>
              <td class="border px-4 py-1">{{ $k->kelurahan }}</td>
              <td class="border px-4 py-1 w-32">
                <a
                  class="inline-block text-center font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300"
                  href="{{ url('/account/kader/'.$k->id) }}">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <button 
                  onclick="deleteAccount({{ $k->id }})"
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
        fetch(local_url+'/account/kader/delete/'+id)
          .then(response => response.text())
          .then((res) => {
            if (res == 'success') {
              Swal.fire({
                  title: 'Data Berhasil Dihapus!',
                  text: '',
                  icon: 'success',
                  confirmButtonColor: '#3085d6'
                })
                .then(()=>{
                  location.reload()
                })
            }
          })
      }
    })
  }
</script>