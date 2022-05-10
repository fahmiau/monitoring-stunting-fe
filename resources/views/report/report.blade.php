@extends('app')

@section('container')
  <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
    <h2 class="text-2xl font-medium ml-8 my-8">Report</h2>
    <div class="w-11/12 ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl">
      <div class="grid grid-cols-4 gap-x-8">

        <div class="">
          <label class="block" for="provinsi_id">Provinsi</label>
          <select onchange="kotaKab(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="provinsi_id" id="provinsi_id">
            <option value="all">-ALL-</option>
            @foreach ($provinsis as $provinsi)
              <option value="{{ $provinsi['id'] }}">{{ $provinsi['provinsi'] }}</option>
            @endforeach
          </select>
        </div>
        <div class="">
          <label class="block" for="kota_kabupaten_id">Kota/Kabupaten</label>
          <select onchange="kecamatan(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kota_kabupaten_id" id="kota_kabupaten_id">
            <option value="all">-ALL-</option>
            {{-- pake fetch di js --}}
          </select>
        </div>
        <div class="">
          <label class="block" for="kecamatan_id">Kecamatan</label>
          <select onchange="kelurahan(this.value)" class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kecamatan_id" id="kecamatan_id">
            <option value="all">-ALL-</option> 
            {{-- pake fetch di js --}}
          </select>
        </div>
        <div class="">
          <label class="block" for="kelurahan_id">Kelurahan</label>
          <select class="border border-gray-700 w-full px-4 py-2 rounded-xl" name="kelurahan_id" id="kelurahan_id">
            <option value="all">-ALL-</option>
            {{-- pake fetch di js --}}
          </select>
        </div>
      </div>
      <div class="flex justify-center flex-col items-center">
        <div class="w-1/3 my-8">
          <canvas class="" id="report-chart" width="undefined" height="undefined"></canvas>
        </div>
        
        <table class="border-separate border table-auto">
          <thead>
            <tr class="border border-blue-600">
              <th class="px-4 border border-blue-600 w-1/12">No</th>
              <th class="px-4 border border-blue-600 w-1/4">Nama Anak</th>
              <th class="px-4 border border-blue-600 w-1/4">Nama Ibu</th>
              <th class="px-4 border border-blue-600 w-1/4">Status</th>
              
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $data_children)
              <tr>
                <td class="border border-blue-400">{{ $loop->iteration }}</td>
                <td class="border border-blue-400"><a href="{{ url('/detail-anak/'.$data_children->children_id) }}">{{ $data_children->children->nama}}</a></td>
                <td class="border border-blue-400">{{ $data_children->children->mother->nama }}</td>
                <td class="border border-blue-400">{{ $data_children->status_stunting }}</td>
              </tr>
            @endforeach
            <tr>
              <td class="border border-blue-400">X</td>
              <td class="border border-blue-400">X</td>
              <td class="border border-blue-400">X</td>
              <td class="border border-blue-400">X</td>
              
            </tr>
          </tbody>
        </table>
      </div>
      </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
  <script>
    function clearSelectForm(element) {
      if (element.childElementCount > 1) {
        while (element.childElementCount > 1) {          
          element.removeChild(element.lastChild);
        }
      }
    }
    function kotaKab(val) {
      var kota_kab_form = document.getElementById('kota_kabupaten_id');
      var kecamatan_form = document.getElementById('kecamatan_id');
      var kelurahan_form = document.getElementById('kelurahan_id');
      clearSelectForm(kota_kab_form);
      clearSelectForm(kecamatan_form);
      clearSelectForm(kelurahan_form);
      fetch('http://127.0.0.1:8000/api/kota-kabupaten/by-provinsi/'+val)
        .then(response => response.json())
        .then((res) => {
          res.forEach(item => {
            var option = document.createElement('option');
            option.value = item.id;
            option.innerHTML = item.kota_kabupaten;
            kota_kab_form.appendChild(option);
          });
        });
    }

    function kecamatan(val) {
      var kecamatan_form = document.getElementById('kecamatan_id');
      var kelurahan_form = document.getElementById('kelurahan_id');
      clearSelectForm(kecamatan_form);
      clearSelectForm(kelurahan_form);
      fetch('http://127.0.0.1:8000/api/kecamatan/by-kota-kabupaten/'+val)
        .then(response => response.json())
        .then((res) => {
          res.forEach(item => {
            var option = document.createElement('option');
            option.value = item.id;
            option.innerHTML = item.kecamatan;
            kecamatan_form.appendChild(option);
          });
        });
    }

    function kelurahan(val) {
      var kelurahan_form = document.getElementById('kelurahan_id');
      clearSelectForm(kelurahan_form);

      fetch('http://127.0.0.1:8000/api/kelurahan/by-kecamatan/'+val)
        .then(response => response.json())
        .then((res) => {
          res.forEach(item => {
            var option = document.createElement('option');
            option.value = item.id;
            option.innerHTML = item.kelurahan;
            kelurahan_form.appendChild(option);
          });
        });
    }

    const data = {
      labels: [
        'Sehat',
        'Terancam'
      ],
      datasets: [{
        label: 'Reprt',
        data: [50, 100],
        backgroundColor: [
          'rgb(54, 162, 235)',
          'rgb(255, 205, 86)'
        ],
        hoverOffset: 1
      }]
    };

    const config = {
      type: 'pie',
      data: data,
    };

    const ctx = document.getElementById('report-chart');
    const myChart = new Chart(ctx, config);
  </script>
@endsection