
@foreach ($childrens as $child)
  @if ($loop->iteration == 2)
  <div class="relative flex py-4 items-center">
    <div class="flex-grow border-t-2 border-white"></div>
  </div>
  @endif
  <div class="ml-8 mr-12">
    <div class="flex flex-wrap items-end">
      <input type="hidden" name="mother_id" id="mother_id" value="{{ $mother->id }}">
      <div class="w-1/2 py-2 px-4">
        <label class="font-medium" for="name">Full Name</label>
        <input
          class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('name') border-red-500 @enderror "
          type="text"
          name="nama"
          id="nama"
          placeholder="John Doe"
          required value="{{ $child->nama }}">
      </div>
      <div class="flex-shrink py-2 px-4">
        <a
          class="underline hover:no-underline block bg-secondary my-1 py-2 px-4 text-white rounded-md"
          href="{{ url('/detail-anak/'.$child->id) }}">
          Detail Anak
        </a>
      </div>
    </div>
    <div id="alamat">
      <div class="flex flex-wrap">
        <div class="w-1/4 py-2 px-4">
          <label class="font-medium" for="provinsi_id">Provinsi</label>
          <select 
            onchange="findKotaKab(this.value)" 
            name="provinsi_id" 
            id="provinsi_id" 
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
            @foreach ($provinsis as $provinsi)
              <option value="{{ $provinsi->id }}" {{ ($provinsi->id == $child->provinsi_id) ? 'selected' : '' }}>{{ $provinsi->provinsi }}</option>
            @endforeach
            {{-- fetch di js --}}
          </select>
        </div>
        <div class="w-1/4 py-2 px-4">
          <label class="font-medium" for="kota_kabupaten_id">Kota/Kabupaten</label>
          <select 
            onchange="findKecamatan(this.value)"
            name="kota_kabupaten_id" 
            id="kota_kabupaten_id"
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
            @foreach ($kota_kabupatens as $kota_kab)
              <option value="{{ $kota_kab->id }}" {{ ($kota_kab->id == $child->kota_kabupaten_id) ? 'selected' : ''}}>{{ $kota_kab->kota_kabupaten }}</option>
            @endforeach
          </select>
        </div>
        <div class="w-1/4 py-2 px-4">
          <label class="font-medium" for="kecamatan_id">Kecamatan</label>
          <select 
            onchange="findKelurahan(this.value)" 
            name="kecamatan_id" 
            id="kecamatan_id" 
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
            @foreach ($kecamatans as $kec)
              <option value="{{ $kec->id }}" {{ ($kec->id == $child->kecamatan_id ? 'selected' : '') }}>{{ $kec->kecamatan }}</option>
            @endforeach
          </select>
        </div>
        <div class="w-1/4 py-2 px-4">
          <label class="font-medium" for="kelurahan_id">Kelurahan</label>
          <select 
            name="kelurahan_id" 
            id="kelurahan_id" 
            class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
            @foreach ($kelurahans as $kel)
              <option value="{{ $kel->id }}" {{ ($kel->id == $child->kelurahan_id ? 'selected' : '') }}>{{ $kel->kelurahan }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div id="data-anak" class="">
    <div class="flex flex-wrap">
      <div class="w-1/4 py-2 px-4">
        <label class="font-medium" for="no_akta">No Akta</label>
        <input
          class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
          type="text"
          name="no_akta" 
          id="no_akta"
          value="{{ $child->no_akta }}">
      </div>
      <div class="w-1/4 py-2 px-4">
        <label class="font-medium" for="anak_ke">Anak Ke</label>
        <input
          class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
          type="number"
          name="anak_ke" 
          id="anak_ke"
          value="{{ $child->anak_ke }}">
      </div>
      <div class="w-1/6 py-2 px-4">
        <label class="font-medium" for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400">
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <div class="w-1/4 py-2 px-4">
        <label class="font-medium" for="tempat_lahir">Tempat Lahir</label>
        <input
          class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
          type="text"
          name="tempat_lahir" 
          id="tempat_lahir"
          value="{{ $child->tempat_lahir }}">
      </div>
      <div class="w-1/4 py-2 px-4">
        <label class="font-medium" for="tanggal_lahir">Tanggal Lahir</label>
        <input
          class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
          type="date"
          name="tanggal_lahir" 
          id="tanggal_lahir"
          value="{{ $child->tanggal_lahir }}">
      </div>
    </div>
    </div>
    <div class="mt-4 ml-4">
      <button class="font-medium text-lg border-2 border-secondary bg-[#06CA51] hover:bg-secondary hover:text-primary py-2 px-10 rounded-md object-center transform duration-300" type="submit">Update Anak</button>
    </div>
  </div>
@endforeach