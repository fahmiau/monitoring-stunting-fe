@extends('app')

@section('container')
<div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
  <h2 class="text-2xl font-medium ml-8 my-8">Create Account</h2>
  {{-- <div class="w-2/3 ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl"> --}}

  <form action="add-new" method="post">
    <div class="ml-8 mr-12">
      <div class="flex flex-wrap">
          @csrf
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="name">Full Name</label>
            <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('name') border-red-500 @enderror " type="text" name="name" id="name" placeholder="John Doe" required value="{{ old('name') }}" autofocus>
          </div>
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="email">Email Address</label>
            <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('email') border-red-500 @enderror " type="email" name="email" id="email" placeholder="name@example.email" required value="{{ old('email') }}">
          </div>
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="password">Password</label>
            <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('password') border-red-500 @enderror " type="password" name="password" id="password" placeholder="min 6 karakter" required value="{{ old('password') }}">
          </div>
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="password_confirmation">Confirm Password</label>
            <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('password_confirmation') border-red-500 @enderror " type="password" name="password_confirmation" id="password_confirmation" placeholder="min 6 karakter" required value="{{ old('confirm-password') }}">
          </div>
        </div>
        <div class="w-1/4 py-2 px-4">
          <label class="font-medium" for="category">Category</label>
          <select onchange="categoryForm(this.value)" name="category" id="category" class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
            <option value="" disabled selected>Kategori</option>
            <option value="User">User</option>
            <option value="Kader">Kader</option>
            <option value="Bidan">Bidan</option>
            <option value="Perawat">Perawat</option>
            <option value="Admin">Admin</option>
          </select>
        </div>
        {{-- invisible show sesuai select --}}
        <div id="add-on-form" class="hidden transform duration-300">
          <div class="flex flex-wrap">
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="provinsi_id">Provinsi</label>
              <select onchange="findKotaKab(this.value)" name="provinsi_id" id="provinsi_id" class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
                <option value="all" disabled selected>-ALL-</option>
                {{-- fetch di js --}}
              </select>
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="kota_kabupaten_id">Kota/Kabupaten</label>
              <select onchange="findKecamatan(this.value)" name="kota_kabupaten_id" id="kota_kabupaten_id" class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
                <option value="all" disabled selected>-ALL-</option>
                {{-- fetch di js --}}
              </select>
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="kecamatan_id">Kecamatan</label>
              <select onchange="findKelurahan(this.value)" name="kecamatan_id" id="kecamatan_id" class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
                <option value="all" disabled selected>-ALL-</option>
                {{-- fetch di js --}}
              </select>
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="kelurahan_id">Kelurahan</label>
              <select name="kelurahan_id" id="kelurahan_id" class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
                <option value="all" disabled selected>-ALL-</option>
                {{-- fetch di js --}}
              </select>
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="nik">NIK</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" type="number" name="nik" id="nik" placeholder="NIK">
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="nomor_telepon">Nomor Telepon</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" type="number" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon">
            </div>
            <div class="w-1/2 py-2 px-4">
              <label class="font-medium" for="alamat">Alamat</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" type="text" name="alamat" id="alamat" placeholder="Alamat">
            </div>
          </div>
        </div>
        
        <div id="user-form" class="hidden transform duration-300">
          <div class="flex flex-wrap">
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="pendidikan">Pendidikan</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" type="text" name="pendidikan" id="pendidikan" placeholder="Pendidikan">
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="pekerjaan">Pekerjaan</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan">
            </div>
            <div class="w-1/6 py-2 px-4">
              <label class="font-medium" for="golongan_darah">Golongan Darah</label>
              <select name="golongan_darah" id="golongan_darah" class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="O">O</option>
                <option value="AB">AB</option>
              </select>
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="tempat_lahir">Tempat Lahir</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir">
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="tanggal_lahir">Tanggal Lahir</label>
              <input class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400" type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir">
            </div>
          </div>
        </div>
        <div class="mt-4 ml-8">
          <button class="font-medium text-lg bg-primary hover:bg-secondary hover:text-primary py-2 px-10 rounded-md object-center transform duration-300" type="submit">Create Account</button>
        </div>
      </div>
    </form>
    {{-- </div> --}}
</div>
<script src="{{ asset('/js/alamat.js') }}"></script>
<script>
  function categoryForm(val) {
    var userForm = document.getElementById("user-form");
    var form = document.getElementById("add-on-form");
    if (val == 'User') {
      if (form.classList.contains("hidden")) {
        provinsi();
        form.classList.remove("hidden");
      }
      userForm.classList.remove("hidden");
    } else if (val == 'Admin'){
      if (!(form.classList.contains("hidden"))) {
        form.classList.add("hidden");
      }
      if (!(userForm.classList.contains("hidden"))) {
        userForm.classList.add("hidden");
      }
    } else {
      if (!(userForm.classList.contains("hidden"))) {
        userForm.classList.add("hidden");
      }
      if (form.classList.contains("hidden")) {
        form.classList.remove("hidden");
        provinsi();
      }
    }
  }
  
</script>
@endsection