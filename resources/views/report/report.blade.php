@extends('app')
@section('title','Report')
@section('container')
  @include('partials.titlePage',['title' => 'Report'])
    <div class="w-11/12 ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl">
      <div class="grid grid-cols-4 gap-x-8">

        <div class="">
          <label class="block" for="provinsi_id">Provinsi</label>
          <select onchange="kotaKab(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="provinsi_id" id="provinsi_id">
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
          <label class="block" for="kota_kabupaten_id">Kota/Kabupaten</label>
          <select onchange="kecamatan(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kota_kabupaten_id" id="kota_kabupaten_id">
            <option value="all">-ALL-</option>
            @if (isset($data_daerah->provinsi_id))    
              @foreach ($kota_kabupatens as $kota_kab)
                <option value="{{ $kota_kab->id }}" {{ ($kota_kab->id == $data_daerah->kota_kabupaten_id) ? 'selected' : ''}}>{{ $kota_kab->kota_kabupaten }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <div class="">
          <label class="block" for="kecamatan_id">Kecamatan</label>
          <select onchange="kelurahan(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kecamatan_id" id="kecamatan_id">
            <option value="all">-ALL-</option>
            @if (isset($data_daerah->provinsi_id))
              @foreach ($kecamatans as $kec)
                <option value="{{ $kec->id }}" {{ ($kec->id == $data_daerah->kecamatan_id ? 'selected' : '') }}>{{ $kec->kecamatan }}</option>
              @endforeach
            @endif
          </select>
        </div>
        <div class="">
          <label class="block" for="kelurahan_id">Kelurahan</label>
          <select onchange="getChildrenData('kelurahan',this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kelurahan_id" id="kelurahan_id">
            <option value="all">-ALL-</option>
            @if (isset($data_daerah->provinsi_id))
              @foreach ($kelurahans as $kel)
                <option value="{{ $kel->id }}" {{ ($kel->id == $data_daerah->kelurahan_id ? 'selected' : '') }}>{{ $kel->kelurahan }}</option>
              @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="flex justify-center flex-col items-center">
        <div class="w-1/2 my-8">
          <canvas class="" id="report-chart" width="undefined" height="undefined"></canvas>
        </div>
        
        <table class="border-separate border table-auto">
          <thead>
            <tr class="border border-blue-600">
              <th class="px-4 border border-blue-600 w-1/12">No</th>
              <th class="px-4 border border-blue-600 w-1/4">Nama Ibu</th>
              <th class="px-4 border border-blue-600 w-1/4">Nama Anak</th>
              <th class="px-4 border border-blue-600 w-1/4">Status Terbaru</th>
              
            </tr>
          </thead>
          <tbody id="data-childrens">
            @foreach ($data as $mother)
              <tr>
                <td class="border border-blue-400 text-center">{{ $loop->iteration }}</td>
                <td class="border border-blue-400 p-2">{{ $mother->nama }}</td>
                <td class="border border-blue-400 p-2">
                  @foreach ($mother->childrens as $children)
                  <div>
                    <a class="underline hover:no-underline" href="{{ url('/children/detail/'.$children->id) }}">{{ $children->nama}}</a>
                  </div>
                  @endforeach
                </td>
                <td class="border border-blue-400 p-2">
                  @foreach ($mother->childrens as $children)
                  <div>
                    @if (!$children->status_children)
                        {{ 'Data Belum Cukup' }}
                        @continue
                    @endif
                    {{ $children->status_children->status_stunting }}
                  </div>
                  @endforeach
                </td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
  <script src="{{ asset('js/daerah-form.js') }}"></script>
@endsection