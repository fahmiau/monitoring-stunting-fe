@extends('app')

@section('container')
<div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
  <h2 class="text-2xl font-medium ml-8 my-8">Detail Anak</h2>
  <div class="container max-w-min ml-8 bg-white filter drop-shadow-xl p-8 rounded-xl">

    <div class="container p-2">  
      <table>
        <tr>
          <td>
            Nama
          </td>
          <td> : </td>
          <td>
            {{ $data->children->nama }}
          </td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td> : </td>
          <td>{{ $data->children->tanggal_lahir }}</td>
        </tr>
        <tr>
          <td>Usia</td>
          <td> : </td>
          <td>X Tahun Y Bulan</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td> : </td>
          <td>{{ $data->children->alamat }}</td>
        </tr>
        <tr>
          <td>Status</td>
          <td> : </td>
          <td>{{ $data->status_stunting }}</td>
        </tr>
      </table>
    </div>
    <div class="w-full bg-white filter drop-shadow-xl p-3 rounded-xl">
      
      <h2 class="text-lg font-medium text-center mb-3">Data Bulanan</h2>
      <table class="border-separate border table-fixed ">
        <thead>
          <tr class="border border-blue-600">
            <th class="px-4 border border-blue-600 w-1/4 ">Bulan Ke -</th>
            <th class="px-4 border border-blue-600 ">Tanggal</th>
            <th class="px-4 border border-blue-600 ">PB</th>
            <th class="px-4 border border-blue-600 ">BB</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data->children->data_childrens as $data)              
          <tr>
            <td class="px-2 border border-blue-400">{{ $data->bulan_ke }}</td>
            <td class="px-2 border border-blue-400">{{ $data->tanggal }}</td>
            <td class="px-2 border border-blue-400">{{ $data->panjang_badan }} cm</td>
            <td class="px-2 border border-blue-400">{{ $data->berat_badan }} kg</td>
          </tr>
          @endforeach

        </tbody>
      </table>
      
    </div>
    
    <div class="max-w-min mt-10 bg-white filter drop-shadow-xl p-3 rounded-xl">
      <h2 class="text-center text-lg font-medium">Grafik Pertumbuhan Berat Badan</h2>
      <div>
        <canvas id="weight" width="1200" height="600"></canvas>
      </div>
      <h2 class="text-center text-lg font-medium my-4">Grafik Pertumbuhan Tinggi Badan</h2>
      <div>
        <canvas id="height" width="800" height="600"></canvas>
      </div>
    </div>
  </div>
</div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
  <script>
    
  createChart('http://localhost:8000/api/weight-girl/all')
  function createChart(url) {
    fetch(url)
    .then(response => response.json())
    .then(response => {
      const labels = response.months;
      const data = {
        labels: labels,
        datasets: [
          {
            label: '-3SD',
            data: response.m3sd,
            borderColor: 'rgb(0, 0, 0)',
            backgroundColor: 'rgba(0,0,0, 0.4)',
            tension: 0.3
          },
          {
            label: '-2SD',
            data: response.m2sd,
            borderColor: 'rgb(200,0,0)',
            backgroundColor: 'rgba(200,0,0, 0.4)',
            tension: 0.3
          },
          // {
          //   label: '-1SD',
          //   data: response.m1sd,
          //   borderColor: 'rgb(54, 162, 235)',
          //   backgroundColor: 'rgba(54, 162, 235, 0.9)',
          //   tension: 0.3
          // },
          {
            label: 'Median',
            data: response.median,
            borderColor: 'rgb(0, 200, 0)',
            backgroundColor: 'rgba(0,200,0, 0.4)',
            tension: 0.3
          },
          // {
          //   label: '1SD',
          //   data: response.p1sd,
          //   borderColor: 'rgb(54, 162, 235)',
          //   backgroundColor: 'rgba(54, 162, 235, 0.9)',
          //   tension: 0.3
          // },
          {
            label: '2SD',
            data: response.p2sd,
            borderColor: 'rgb(200,0,0)',
            backgroundColor: 'rgba(200,0,0, 0.4)',
            tension: 0.3
          },
          {
            label: '3SD',
            data: response.p3sd,
            borderColor: 'rgb(0, 0, 0)',
            backgroundColor: 'rgba(0,0,0, 0.4)',
            tension: 0.3
          }
        ]
      };
      const config = {
        type: 'line',
        data: data,
        options: {
          responsive: true,
          interaction: {
            mode: 'index',
            intersect: false,
          },
          stacked: false,
          plugins: {
            title: {
              display: false,
            }
          },
          scales: {
            y: {
              type: 'linear',
              display: true,
              position: 'left',
            },
            // y1: {
            //   type: 'linear',
            //   display: true,
            //   position: 'right',

            //   // grid line settings
            //   grid: {
            //     drawOnChartArea: false, // only want the grid lines for one axis to show up
            //   },
            // },
          }
        },
      };
      const ctx = document.getElementById('weight');
      const ctx1 = document.getElementById('height');

      const weightChart = new Chart(ctx, config);
      const heightChart = new Chart(ctx1, config);
    });
  }
</script>
@endsection