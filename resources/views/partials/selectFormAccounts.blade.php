<div class="grid grid-cols-4 gap-x-8 w-10/12 mb-5">
  <div class="">
    <label class="block font-bold" for="provinsi_id">Provinsi</label>
    <select onchange="provinsi(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="provinsi_id" id="provinsi_id">
      <option value="all">-ALL-</option>
      @if (isset($data_daerah->provinsi_id))
      @foreach ($provinsis as $provinsi)
      <option value="{{ $provinsi->id }}" {{ ($provinsi->id == $data_daerah->provinsi_id) ? 'selected' : '' }}>{{ $provinsi->provinsi }}</option>
      @endforeach 
      @else
        @foreach ($provinsis as $provinsi)
          <option value="{{ $provinsi->id }}">{{ $provinsi->provinsi }}</option>
        @endforeach
        @endif
      </select>
  </div>
  <div class="">
    <label class="block font-bold" for="kota_kabupaten_id">Kota/Kabupaten</label>
    <select onchange="kotaKab(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kota_kabupaten_id" id="kota_kabupaten_id">
      <option value="all">-ALL-</option>
      @if (isset($data_daerah->provinsi_id))    
      @foreach ($kota_kabupatens as $kota_kab)
      <option value="{{ $kota_kab->id }}" {{ ($kota_kab->id == $data_daerah->kota_kabupaten_id) ? 'selected' : ''}}>{{ $kota_kab->kota_kabupaten }}</option>
      @endforeach
      @endif
    </select>
  </div>
  <div class="">
    <label class="block font-bold" for="kecamatan_id">Kecamatan</label>
    <select onchange="kecamatan(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kecamatan_id" id="kecamatan_id">
      <option value="all">-ALL-</option>
      @if (isset($data_daerah->provinsi_id))
      @foreach ($kecamatans as $kec)
      <option value="{{ $kec->id }}" {{ ($kec->id == $data_daerah->kecamatan_id ? 'selected' : '') }}>{{ $kec->kecamatan }}</option>
      @endforeach
      @endif
    </select>
  </div>
  <div class="">
    <label class="block font-bold" for="kelurahan_id">Kelurahan</label>
    <select onchange="kelurahan(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kelurahan_id" id="kelurahan_id">
      <option value="all">-ALL-</option>
      @if (isset($data_daerah->provinsi_id))
      @foreach ($kelurahans as $kel)
      <option value="{{ $kel->id }}" {{ ($kel->id == $data_daerah->kelurahan_id ? 'selected' : '') }}>{{ $kel->kelurahan }}</option>
      @endforeach
      @endif
    </select>
  </div>
</div>