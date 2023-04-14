@extends('app')
@section('title','Account Detail Nakes')
@section('container')
  @include('partials.titlePage',['title' => 'Account Detail Nakes'])
  <form action="{{ url('/account/nakes/update') }}" method="post">
    <div class="ml-8 mr-12">
      <h3 class="font-bold text-xl pl-2 text-secondary">Profil Nakes</h3>
      <div class="flex flex-wrap">
        @csrf
        <div class="w-1/2 py-2 px-4">
          <input type="hidden" name="id" value="{{ $nakes->id }}">
          <input type="hidden" name="user_id" value="{{ $nakes->user_id }}">
          <label class="font-medium" for="nama">Nama Lengkap</label>
          <input
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('name') border-red-500 @enderror " 
            type="text" 
            name="nama" 
            id="nama" 
            required value="{{ $nakes->user->name }}">
        </div>
        <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="email">Email Address</label>
          <input
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('email') border-red-500 @enderror "
            type="email" name="email" id="email" placeholder="name@example.email"
            required value="{{ $nakes->user->email }}">
        </div>
        {{-- <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="password">Password</label>
          <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('password') border-red-500 @enderror " type="password" name="password" id="password" placeholder="min 6 karakter" required value="{{ old('password') }}">
        </div>
        <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="password_confirmation">Confirm Password</label>
          <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('password_confirmation') border-red-500 @enderror " type="password" name="password_confirmation" id="password_confirmation" placeholder="min 6 karakter" required value="{{ old('confirm-password') }}">
        </div>
      </div>
      <div class="my-4 ml-4">
        <a
          class="font-medium text-lg border-2 border-secondary bg-[#06CA51] hover:bg-secondary hover:text-primary py-3 px-10 rounded-md object-center transform duration-300"
          onclick="submit">
          Update Profil
        </a>
      </div>
      <hr> --}}
      </div>
      <div class="w-1/4 py-2 px-4">
        <label class="font-medium" for="category">Category</label>
        <select
          onchange="categoryForm(this.value)"
          name="category"
          id="category"
          class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
          {{-- <option value="" disabled selected>Kategori</option> --}}
          <option value="User" disabled>Ibu</option>
          <option value="Kader" disabled>Kader</option>
          <option value="Bidan" disabled {{ ($nakes->user->role->category == 'Bidan') ? 'selected' : '' }}>Bidan</option>
          <option value="Perawat" disabled {{ ($nakes->user->role->category == 'Perawat') ? 'selected' : '' }}>Perawat</option>
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
              value="{{ $nakes->nik }}" disabled>
          </div>
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="alamat">Alamat</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="text" 
              name="alamat" 
              id="alamat"
              value="{{ $nakes->alamat }}">
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
                <option value="{{ $provinsi->id }}" {{ ($provinsi->id == $nakes->provinsi_id) ? 'selected' : '' }}>{{ $provinsi->provinsi }}</option>
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
                <option value="{{ $kota_kab->id }}" {{ ($kota_kab->id == $nakes->kota_kabupaten_id) ? 'selected' : ''}}>{{ $kota_kab->kota_kabupaten }}</option>
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
                <option value="{{ $kec->id }}" {{ ($kec->id == $nakes->kecamatan_id ? 'selected' : '') }}>{{ $kec->kecamatan }}</option>
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
                <option value="{{ $kel->id }}" {{ ($kel->id == $nakes->kelurahan_id ? 'selected' : '') }}>{{ $kel->kelurahan }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      
      <div id="user-form" class="transform duration-300">
        <div class="flex flex-wrap">
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="nomor_telepon">No Hp Pribadi</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="number" 
              name="nomor_telepon" 
              id="nomor_telepon"
              value="{{ $nakes->nomor_telepon }}">
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="tempat_kerja">Unit Kerja</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="text" 
              name="tempat_kerja" 
              id="tempat_kerja"
              value="{{ $nakes->user->tempat_kerja->tempat_kerja }}">
          </div>
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="nomor_telepon_kerja">Nomor Telepon Unit</label>
            <input
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
              type="text"
              name="nomor_telepon_kerja"
              id="nomor_telepon_kerja"
              value="{{ $nakes->user->tempat_kerja->nomor_telepon_kerja }}">
          </div>
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="alamat_kerja">Alamat Unit</label>
            <input
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
              type="text"
              name="alamat_kerja"
              id="alamat_kerja"
              value="{{ $nakes->user->tempat_kerja->alamat_kerja }}">
          </div>
        </div>
        </div>
      </div>
      <div class="mt-4 ml-8">
        <button class="font-medium text-lg border-2 border-secondary bg-[#06CA51] hover:bg-secondary hover:text-primary py-2 px-10 rounded-md object-center transform duration-300" type="submit">Update Data</button>
      </div>
    </div>
  </form>
  {{-- @include('account.childrenProfile',['childrens'=>$nakes->childrens]) --}}
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
