@extends('app')
@section('title','Detail')
@section('container')
@include('partials.titlePage',['title' => 'Detail Anak'])
  <div class="container w-11/12 ml-8 filter drop-shadow-xl p-8 rounded-xl">
    <form action="{{ url('/children/update') }}" method="POST">
      @csrf
      <div class="w-full bg-gray-100 filter drop-shadow-xl p-4 rounded-xl border-t-4 border-t-secondary">
        <div class="flex flex-wrap items-end">
          <input type="hidden" name="mother_id" id="mother_id" value="{{ $children->mother->id }}">
          <input type="hidden" name="id" id="id" value="{{ $children->id }}">
          <div class="w-1/2 py-2 px-4">
            <label class="font-medium" for="name">Nama Lengkap</label>
            <input
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400 @error('name') border-red-500 @enderror "
              type="text"
              name="nama"
              id="nama"
              placeholder="John Doe"
              required value="{{ $children->nama }}">
          </div>
        </div>
        <div id="alamat">
          <div class="flex flex-wrap">
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="nik">NIK</label>
              <input
                class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
                type="number" name="nik" id="nik" value="{{ $children->nik }}">
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="alamat">Alamat</label>
              <input
                class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
                type="text" name="alamat" id="alamat" value="{{ $children->alamat }}">
            </div>
          </div>
          <div class="flex flex-wrap">
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="provinsi_id">Provinsi</label>
              <select 
                onchange="findKotaKab(this.value)" 
                name="provinsi_id" 
                id="provinsi_id" 
                class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
                >
                <option value="all" disabled>-ALL-</option>
                @foreach ($provinsis as $provinsi)
                  <option value="{{ $provinsi->id }}" {{ ($provinsi->id == $children->provinsi_id) ? 'selected' : '' }}>{{ $provinsi->provinsi }}</option>
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
                class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
                >
                <option value="all" disabled>-ALL-</option>
                @foreach ($kota_kabupatens as $kota_kab)
                  <option value="{{ $kota_kab->id }}" {{ ($kota_kab->id == $children->kota_kabupaten_id) ? 'selected' : ''}}>{{ $kota_kab->kota_kabupaten }}</option>
                @endforeach
              </select>
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="kecamatan_id">Kecamatan</label>
              <select 
                onchange="findKelurahan(this.value)" 
                name="kecamatan_id" 
                id="kecamatan_id" 
                class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
                >
                <option value="all" disabled>-ALL-</option>
                @foreach ($kecamatans as $kec)
                  <option value="{{ $kec->id }}" {{ ($kec->id == $children->kecamatan_id ? 'selected' : '') }}>{{ $kec->kecamatan }}</option>
                @endforeach
              </select>
            </div>
            <div class="w-1/4 py-2 px-4">
              <label class="font-medium" for="kelurahan_id">Kelurahan</label>
              <select 
                name="kelurahan_id" 
                id="kelurahan_id" 
                class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
                >
                <option value="all" disabled>-ALL-</option>
                @foreach ($kelurahans as $kel)
                  <option value="{{ $kel->id }}" {{ ($kel->id == $children->kelurahan_id ? 'selected' : '') }}>{{ $kel->kelurahan }}</option>
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
              value="{{ $children->no_akta }}">
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="anak_ke">Anak Ke</label>
            <input
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
              type="number"
              name="anak_ke" 
              id="anak_ke"
              value="{{ $children->anak_ke }}">
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
              value="{{ $children->tempat_lahir }}">
          </div>
          <div class="w-1/4 py-2 px-4">
            <label class="font-medium" for="tanggal_lahir">Tanggal Lahir</label>
            <input
              class="block w-full my-1 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
              type="date"
              name="tanggal_lahir" 
              id="tanggal_lahir"
              value="{{ $children->tanggal_lahir }}">
          </div>
        </div>
        </div>
        <div class="mt-4 ml-4">
          <button
            class="font-medium text-lg border-2 border-secondary bg-[#06CA51] hover:bg-secondary hover:text-primary py-2 px-10 rounded-md object-center transform duration-300"
            type="submit">
            Update Anak
          </button>
        </div>
      </div>
    </form>

    <div class="w-full bg-gray-100 filter drop-shadow-xl p-4 rounded-xl border-t-4 border-t-secondary mt-10">
      <input type="hidden" value="{{ $children->id }}" name="childrenId" id="childrenId">
      <input type="hidden" name="gender" id="gender" value="{{ ($children->jenis_kelamin == 'Laki-laki') ? 'boy' : 'girl' }}">
      <h2 class="text-lg font-medium text-center mb-3">Data Bulanan</h2>
      <table id="data-children-table" class="border-collapse border table-fixed ml-4 mb-4 w-11/12">
        <thead>
          <tr class="border border-blue-600 bg-blue-100">
            <th class="px-4 py-1 border-2 border-blue-600 w-1/12">Bulan Ke -</th>
            <th class="px-4 py-1 border-2 border-blue-600 w-3/12">Tanggal</th>
            <th class="px-4 py-1 border-2 border-blue-600 w-2/12">Tempat</th>
            <th class="px-4 py-1 border-2 border-blue-600 w-2/12">PB</th>
            <th class="px-4 py-1 border-2 border-blue-600 w-2/12">BB</th>
            <th class="px-4 py-1 border-2 border-blue-600 w-2/12">Action</th>
          </tr>
        </thead>
        <tbody>
          @if($children->data_childrens)
            @foreach ($children->data_childrens as $data_children)
            <input type="hidden" name="data_children_id_{{ $loop->iteration }}" id="data_children_id_{{ $loop->iteration }}" value="{{ $data_children->id }}">              
              <tr id="row_{{ $loop->iteration }}">
                <td class="px-2 py-1 border-2 border-blue-400">
                  <input
                    class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
                    type="number"
                    name="bulan_ke_{{ $loop->iteration }}"
                    id="bulan_ke_{{ $loop->iteration }}"
                    value="{{ $data_children->bulan_ke }}">
                </td>
                <td class="px-2 py-1 border-2 border-blue-400">
                  <input 
                    class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
                    type="date"
                    name="tanggal_{{ $loop->iteration }}"
                    id="tanggal_{{ $loop->iteration }}" placeholder="Tanggal"
                    value="{{ $data_children->tanggal }}">
                </td>
                <td class="px-2 py-1 border-2 border-blue-400">
                  <input 
                    class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
                    type="text"
                    name="tempat_{{ $loop->iteration }}"
                    id="tempat_{{ $loop->iteration }}" placeholder="Tempat"
                    value="{{ $data_children->tempat }}">
                </td>
                <td class="px-2 py-1 border-2 border-blue-400">
                  <input
                    class="w-3/4 rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
                    type="number"
                    min="0"
                    step="0.1"
                    name="panjang_badan_{{ $loop->iteration }}"
                    id="panjang_badan_{{ $loop->iteration }}"
                    value="{{ $data_children->panjang_badan }}">
                  cm
                </td>
                <td class="px-2 py-1 border-2 border-blue-400">
                  <input
                    class="w-3/4 rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
                    type="number"
                    min="0"
                    step="0.1"
                    name="berat_badan_{{ $loop->iteration }}"
                    id="berat_badan_{{ $loop->iteration }}"
                    value="{{ $data_children->berat_badan }}"/>
                  kg
                </td>
                <td class="p-2 border-2 border-blue-400">
                  <button
                    id="data_children_update_btn_{{ $loop->iteration }}"
                    onclick="updateDataChildren({{ $loop->iteration }})"
                    class="w-2/3 font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300">
                    EDIT
                  </button>
                  <button
                    onclick="deleteDataChildren({{ $data_children->id }})"
                    class=" bg-red-600 py-2 px-2 border-secondary border-2 rounded-md text-white hover:text-black" href="">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </td>
              </tr>
              @if ($loop->last)
                @include('report.lastRow',[
                  'bulan_ke'=>$data_children->bulan_ke+1,
                  'last_row'=>$loop->iteration])
              @endif
            @endforeach
          @else
            @include('report.lastRow',[
              'bulan_ke'=>0,
              'last_row'=>0])
          @endif
        </tbody>
      </table>
      <div class="flex flex-wrap gap-x-4 w-full py-2 px-4">
        @if ($children->status_children != null)
          <input type="hidden" name="status_children_id" id="status_children_id" value="{{ $children->status_children->id }}">
        @endif
          <label class="font-medium w-full" for="status_children">Status Data Kembang Anak</label>
          <select
            class="inline-block w-1/4 rounded-md pl-4 text-lg py-2 shadow-md border border-transparent focus:outline-none focus:ring-2 ring-blue-400"
            type="number" name="status_children" id="status_children">
            @if ($children->status_children == null)
              <option value="" selected>Belum Ada</option>
              <option value="Sangat Dibawah Standar">
                Sangat Dibawah Standar
              </option>
              <option value="Dibawah Standar">
                Dibawah Standar
              </option>
              <option value="Normal">
                Normal
              </option>
              <option value="Diatas Standar">
                Diatas Standar
              </option>
            @else
              <option value="Sangat Dibawah Standar"
                {{ ($children->status_children->status_stunting == 'Sangat Dibawah Standar') ? 'selected' : '' }}>
                Sangat Dibawah Standar
              </option>
              <option value="Dibawah Standar"
                {{ ($children->status_children->status_stunting == 'Dibawah Standar') ? 'selected' : '' }}>
                Dibawah Standar
              </option>
              <option value="Normal"
                {{ ($children->status_children->status_stunting == 'Normal') ? 'selected' : '' }}>
                Normal
              </option>
              <option value="Diatas Standar"
                {{ ($children->status_children->status_stunting == 'Diatas Standar') ? 'selected' : '' }}>
                Diatas Standar
              </option>
            @endif
          </select>  
          <button
            class="inline-block font-medium border-2 h-11/12 px-4 border-secondary bg-[#06CA51] hover:bg-secondary hover:text-primary rounded-md object-center transform duration-300"
            id="data_children_add" name="add-data"
            onclick="updateStatusChildren()">
            Ubah Status
          </button>
      </div>
    </div>
    
    <div class="mt-10 bg-white filter drop-shadow-xl p-4 rounded-xl border-t-4 border-t-secondary h-">
      <h2 class="text-center text-lg font-medium my-4">Grafik Pertumbuhan Tinggi Badan</h2>
      <div>
        <canvas id="height" style="width: 100%; height: 500px;"></canvas>
      </div>
    </div>
    <div class="mt-10 bg-white filter drop-shadow-xl p-4 rounded-xl border-t-4 border-t-secondary">
      <h2 class="text-center text-lg font-medium my-4">Grafik Pertumbuhan Berat Badan</h2>
      <div>
        <canvas id="weight" style="width: 100%; height: 500px;"></canvas>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
  <script src="{{ asset('js/data-children.js') }}"></script>
  <script src="{{ asset('js/alamat.js') }}"></script>
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
  <script>
    function deleteDataChildren(id) {
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
          fetch(local_url+'/data-children/delete/'+id)
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
  <script>
  var gender = document.getElementById('gender').value
  var childrenId = parseInt(document.getElementById('childrenId').value)
  createChart(api_url+'graph/'+gender+'/height/'+childrenId,'height')
  createChart(api_url+'graph/'+gender+'/weight/'+childrenId,'weight')
  
  function createChart(url,type) {
    fetch(url)
    .then(response => response.json())
    .then(response => {
      const labels = response.months
      const dataChildrenLength = response.data_children.length;
      const limit = 10 + dataChildrenLength;

      const data = {
        labels: labels,
        datasets: [
          {
            label: 'Data Anak',
            data: response.data_children,
            borderColor: 'rgb(33, 255, 249)',
            backgroundColor: 'rgba(43,45,66, 0.8)',
            tension: 0.3
          },
          {
            label: '-3SD',
            data: response.negative_3sd,
            borderColor: 'rgb(0, 0, 0)',
            backgroundColor: 'rgba(0,0,0, 0.4)',
            tension: 0.3
          },
          {
            label: '-2SD',
            data: response.negative_2sd,
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
            data: response.positive_2sd,
            borderColor: 'rgb(200,0,0)',
            backgroundColor: 'rgba(200,0,0, 0.4)',
            tension: 0.3
          },
          {
            label: '3SD',
            data: response.positive_3sd,
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
            x: {
              title: {
                display: true,
                text: 'Bulan'
              }
            },
            y: {
              title: {
                display: true,
                text: type === 'weight' ? 'Berat Badan (kg)' : 'Tinggi Badan (cm)'
              }
            }
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
      if (type == 'weight') {
        const ctx = document.getElementById('weight');
        const weightChart = new Chart(ctx, config);
      } else {
        const ctx1 = document.getElementById('height');
        const heightChart = new Chart(ctx1, config);
      }
    });
  }
</script>
@endsection