@extends('app')
@section('title','Account Detail Kader')
@section('container')
  @include('partials.titlePage',['title' => 'Account Detail Kader'])
  <form action="{{ url('/account/kader/update') }}" method="post">
    <div class="ml-8 mr-12">
      <h3 class="font-bold text-xl pl-2 text-secondary">Profil Kader</h3>
      <div class="flex flex-wrap">
        @csrf
        <div class="w-1/2 py-2 px-4">
          <input type="hidden" name="id" value="{{ $kader->id }}">
          <input type="hidden" name="user_id" value="{{ $kader->user_id }}">
          <label class="font-medium" for="nama">Nama Lengkap</label>
          <input
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('name') border-red-500 @enderror " 
            type="text" 
            name="nama" 
            id="nama" 
            required value="{{ $kader->user->name }}">
        </div>
        <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="email">Email Address</label>
          <input
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('email') border-red-500 @enderror "
            type="email" name="email" id="email" placeholder="name@example.email"
            required value="{{ $kader->user->email }}">
        </div>
        {{-- <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="password">Password</label>
          <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('password') border-red-500 @enderror " type="password" name="password" id="password" placeholder="min 6 karakter" required value="{{ old('password') }}">
        </div>
        <div class="w-1/2 py-2 px-4">
          <label class="font-medium" for="password_confirmation">Confirm Password</label>
          <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('password_confirmation') border-red-500 @enderror " type="password" name="password_confirmation" id="password_confirmation" placeholder="min 6 karakter" required value="{{ old('confirm-password') }}">
        </div> --}}
      {{-- </div> --}}
      <div class="w-1/4 py-2 px-4">
        <label class="font-medium" for="category">Category</label>
        <select
          onchange="categoryForm(this.value)"
          name="category"
          id="category"
          class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
          {{-- <option value="" disabled selected>Kategori</option> --}}
          <option value="User" disabled>Ibu</option>
          <option value="Kader" selected>Kader</option>
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
              value="{{ $kader->nik }}" disabled>
          </div>
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="alamat">Alamat</label>
            <input 
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" 
              type="text" 
              name="alamat" 
              id="alamat"
              value="{{ $kader->alamat }}">
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
                <option value="{{ $provinsi->id }}" {{ ($provinsi->id == $kader->provinsi_id) ? 'selected' : '' }}>{{ $provinsi->provinsi }}</option>
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
                <option value="{{ $kota_kab->id }}" {{ ($kota_kab->id == $kader->kota_kabupaten_id) ? 'selected' : ''}}>{{ $kota_kab->kota_kabupaten }}</option>
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
                <option value="{{ $kec->id }}" {{ ($kec->id == $kader->kecamatan_id ? 'selected' : '') }}>{{ $kec->kecamatan }}</option>
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
                <option value="{{ $kel->id }}" {{ ($kel->id == $kader->kelurahan_id ? 'selected' : '') }}>{{ $kel->kelurahan }}</option>
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
              value="{{ $kader->nomor_telepon }}">
          </div>
        </div>
        </div>
      </div>
      <div class="mt-4 ml-8">
        <button class="font-medium text-lg border-2 border-secondary bg-[#06CA51] hover:bg-secondary hover:text-primary py-2 px-10 rounded-md object-center transform duration-300" type="submit">Update Data</button>
      </div>
    </div>
  </form>
  {{-- @include('account.childrenProfile',['childrens'=>$kader->childrens]) --}}
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