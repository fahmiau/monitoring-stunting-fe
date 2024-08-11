@extends('app')
@section('title','Account Detail')
@section('container')
  @include('partials.titlePage',['title' => 'Account Detail'])
  <form action="{{ url('/account/mother/update') }}" method="post">
    <div class="ml-8 mr-12">
      <h3 class="font-bold text-xl pl-2 text-secondary">Profil Ibu</h3>
      <div class="flex flex-wrap">
        @csrf
        <div class="w-1/2 py-2 px-4">
          <input type="hidden" name="id" value="{{ $mother->id }}">
          <input type="hidden" name="user_id" value="{{ $mother->user_id }}">
          <label class="font-medium" for="nama">Nama Lengkap</label>
          <input
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('name') border-red-500 @enderror " 
            type="text" 
            name="nama" 
            id="nama" 
            required value="{{ $mother->nama }}">
        </div>
        {{-- <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="email">Email Address</label>
          <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('email') border-red-500 @enderror " type="email" name="email" id="email" placeholder="name@example.email" required value="{{ old('email') }}">
        </div> --}}
        {{-- <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="password">Password</label>
          <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('password') border-red-500 @enderror " type="password" name="password" id="password" placeholder="min 6 karakter" required value="{{ old('password') }}">
        </div>
        <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="password_confirmation">Confirm Password</label>
          <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('password_confirmation') border-red-500 @enderror " type="password" name="password_confirmation" id="password_confirmation" placeholder="min 6 karakter" required value="{{ old('confirm-password') }}">
        </div> --}}
      </div>
      <div class="w-1/4 py-2 px-4">
        <label class="font-medium" for="category">Category</label>
        <select
          onchange="categoryForm(this.value)"
          name="category"
          id="category"
          class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
          <option value="User" selected>Ibu</option>
          <option value="Kader" disabled>Kader</option>
          <option value="Bidan" disabled>Bidan</option>
          <option value="Perawat" disabled>Perawat</option>
          <option value="Admin" disabled>Admin</option>
        </select>
      </div>
      <div id="add-on-form" class="transform duration-300">
        <div class="flex flex-wrap">
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="nik">NIK</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="number" 
              name="nik" 
              id="nik"
              value="{{ $mother->nik }}">
          </div>
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="alamat">Alamat</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="text" 
              name="alamat" 
              id="alamat"
              value="{{ $mother->alamat }}">
          </div>
        </div>
        <div class="flex flex-wrap">
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="provinsi_id">Provinsi</label>
            <select
              name="provinsi_id"
              id="provinsi_id"
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
              <option value="all" disabled>-ALL-</option>
              @foreach ($provinsis as $provinsi)
                <option value="{{ $provinsi->id }}" {{ ($provinsi->id == $mother->provinsi_id) ? 'selected' : '' }}>{{ $provinsi->provinsi }}</option>
              @endforeach
              {{-- fetch di js --}}
            </select>
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="kota_kabupaten_id">Kota/Kabupaten</label>
            <select
              name="kota_kabupaten_id"
              id="kota_kabupaten_id"
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
              <option value="all" disabled>-ALL-</option>
              @foreach ($kota_kabupatens as $kota_kab)
                <option value="{{ $kota_kab->id }}" {{ ($kota_kab->id == $mother->kota_kabupaten_id) ? 'selected' : ''}}>{{ $kota_kab->kota_kabupaten }}</option>
              @endforeach
            </select>
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="kecamatan_id">Kecamatan</label>
            <select
              name="kecamatan_id"
              id="kecamatan_id"
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
              <option value="all" disabled>-ALL-</option>
              @foreach ($kecamatans as $kec)
                <option value="{{ $kec->id }}" {{ ($kec->id == $mother->kecamatan_id ? 'selected' : '') }}>{{ $kec->kecamatan }}</option>
              @endforeach
            </select>
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="kelurahan_id">Kelurahan</label>
            <select 
              name="kelurahan_id" 
              id="kelurahan_id" 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
              <option value="all" disabled>-ALL-</option>
              @foreach ($kelurahans as $kel)
                <option value="{{ $kel->id }}" {{ ($kel->id == $mother->kelurahan_id ? 'selected' : '') }}>{{ $kel->kelurahan }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      
      <div id="user-form" class="transform duration-300">
        <div class="flex flex-wrap">
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="pendidikan">Pendidikan</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="text" 
              name="pendidikan" 
              id="pendidikan"
              value="{{ $mother->pendidikan }}">
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="pekerjaan">Pekerjaan</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="text" 
              name="pekerjaan" 
              id="pekerjaan"
              value="{{ $mother->pekerjaan }}">
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="nomor_telepon">Nomor Telepon</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="number" 
              name="nomor_telepon" 
              id="nomor_telepon"
              value="{{ $mother->nomor_telepon }}">
          </div>
        </div>
        <div class="flex flex-wrap">
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="tempat_lahir">Tempat Lahir</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="text" 
              name="tempat_lahir" 
              id="tempat_lahir"
              value="{{ $mother->tempat_lahir }}">
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="tanggal_lahir">Tanggal Lahir</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="date" 
              name="tanggal_lahir" 
              id="tanggal_lahir"
              value="{{ $mother->tanggal_lahir }}">
          </div>
          <div class="w-1/6 py-2 px-4">
            <label class="font-medium" for="golongan_darah">Golongan Darah</label>
            <select 
              name="golongan_darah" 
              id="golongan_darah" 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
              <option value="A" {{ ($mother->golongan_darah == 'A') ? 'selected' : '' }}>A</option>
              <option value="B" {{ ($mother->golongan_darah == 'B') ? 'selected' : '' }}>B</option>
              <option value="O" {{ ($mother->golongan_darah == 'O') ? 'selected' : '' }}>O</option>
              <option value="AB" {{ ($mother->golongan_darah == 'AB') ? 'selected' : '' }}>AB</option>
            </select>
          </div>
        </div>
      </div>
      <div class="mt-4 ml-4">
        <button class="font-medium text-lg border-2 border-secondary bg-[#06CA51] hover:bg-secondary hover:text-primary py-2 px-10 rounded-md object-center transform duration-300" type="submit">Update Data</button>
      </div>
    </div>
  </form>
  <div class="relative flex py-4 items-center">
    <div class="w-8 border-t-2 border-white"></div>
    <span class="flex-shrink font-medium text-xl">Profil Anak</span>
    <div class="flex-grow border-t-2 border-white"></div>
  </div>
  <a href="{{ url('/children/add/'.$mother->id) }}" class="ml-8 mb-5 max-w-min inline-block">
    <div class="flex max-w-min bg-white rounded-xl hover:bg-gray-600 hover:text-white">
      <div class="p-2 border border-gray-600 rounded-l-xl">+</div>
      <div class="p-2 border border-gray-600 rounded-r-xl w-24">Add New</div>
    </div>
  </a>
  
  <div class="ml-8 mb-8">
    <table class="border-collapse border bg-white w-3/4" id="profil-anak">
      <thead>
        <tr class="bg-blue-100">
          <th class="px-4 py-1 border w-8">No</th>
          <th class="px-4 py-1 border w-4/12">Nama Anak</th>
          <th class="px-4 py-1 border w-8">Anak Ke</th>
          <th class="px-4 py-1 border w-4/12">Status</th>
          <th class="px-4 py-1 border w-2/12">Action</th>
          
        </tr>
      </thead>
      <tbody>
        @foreach ($mother->childrens as $children)
          <tr class="hover:bg-blue-50">
            <td class="border px-4 py-1">{{ $loop->iteration }}</td>
            <td class="border px-4 py-1">
              <a class="underline hover:no-underline" href="{{ url('/children/detail/'.$children->id) }}">{{ $children->nama}}</a>
            </td>
            <td class="border px-4 py-1">{{ $children->anak_ke }}</td>
            <td class="border px-4 py-1">
              @if (isset($children->status_children->status_stunting))
                {{ $children->status_children->status_stunting }}
              @else
                Belum Ada
              @endif
            </td>
            <td class="border px-4 py-1 w-32">
              <a
                class="inline-block text-center w-2/3 font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300"
                href="{{ url('/children/detail/'.$children->id) }}">
                EDIT
              </a>
              <button 
                onclick="deleteChildren({{ $children->id }})"
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
  {{-- @include('account.childrenProfile',['childrens'=>$mother->childrens]) --}}
  <script src="{{ asset('/js/alamat.js') }}"></script>
  <script>
    var inputs = document.querySelectorAll('input')
    inputs.forEach(input => {
      input.onchange = function (){
        input.classList.add("border-red-500","border-2");
        let label = input.previousElementSibling;
        label.classList.add("text-red-500","font-bold")
      };
    });
    
    var selects = document.querySelectorAll('select')
    selects.forEach(select => {
      select.onchange = function (){
        select.classList.add("border-red-500","border-2");
        let label = select.previousElementSibling;
        label.classList.add("text-red-500","font-bold")
        switch (select.getAttribute("id")) {
          case "provinsi_id":
            findKotaKab(select.value)
          break;
          case "kota_kabupaten_id":
            findKecamatan(select.value)
          break;
          case "kecamatan_id":
            findKelurahan(select.value)
          break;
          default:
            break;
        }
      };
    });
  </script>
@endsection
<script>
  function deleteChildren(id) {
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
        fetch(local_url+'/children/delete/'+id)
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