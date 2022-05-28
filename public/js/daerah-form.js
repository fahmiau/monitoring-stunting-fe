function clearSelectForm(element) {
  while (element.childElementCount > 1) {          
    element.removeChild(element.lastChild);
  }
}

const data = {
  labels: [
    'Sangat Dibawah Standar',
    'Dibawah Standar',
    'Normal',
    'Diatas Standar'
  ],
  datasets: [{
    label: 'Report',
    data: [
      0,
      0,
      0,
      0,
    ],
    backgroundColor: [
      'rgb(55, 0, 0)',
      'rgb(150, 0, 0)',
      'rgb(20, 120, 20)',
      'rgb(0, 50, 0)',
    ],
    hoverOffset: 2
  }]
};

const config = {
  type: 'pie',
  data: data,
};

const ctx = document.getElementById('report-chart');
const myChart = new Chart(ctx, config);

graphStatus('kelurahan',document.getElementById('kelurahan_id').value)

function getChildrenData(type,id) {
  var children_table = document.getElementById('data-childrens')
  while (children_table.childElementCount > 0) {
    children_table.removeChild(children_table.lastChild)
  }
  graphStatus(type,id)
  axios({
    method : 'get',
    url : 'localhost:8080/childrens/'+type+'/'+id,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach((mother,index) => {
      const tr = document.createElement('tr')
      var childrensHtml = ''
      mother.childrens.forEach(children => {
          childrensHtml += '<div>'+
          '<a class="underline hover:no-underline" href="localhost:8080/detail-anak/'+children.id+'">'+children.nama+'</a>'+
          '</div>'
        })
      var statusHtml = ''
      mother.childrens.forEach(children => {
        statusHtml += '<div>'+
        ((!children.status_children) ? 'Data Belum Cukup' : children.status_children.status_stunting)+
        '</div>'
      })
      tr.innerHTML =
        '<td class="border border-blue-400 text-center">'+(index+1)+'</td>'+
        '<td class="border border-blue-400 p-2">'+mother.nama+'</td>'+
        '<td class="border border-blue-400 p-2">'+
        childrensHtml+
        '</td>'+
        '<td class="border border-blue-400 p-2">'+
        statusHtml+
        '</td>'     
      children_table.appendChild(tr)
    })
  })
}

function kotaKab(val) {
  var kota_kab_form = document.getElementById('kota_kabupaten_id');
  var kecamatan_form = document.getElementById('kecamatan_id');
  var kelurahan_form = document.getElementById('kelurahan_id');
  getChildrenData('provinsi',val)
  clearSelectForm(kota_kab_form);
  clearSelectForm(kecamatan_form);
  clearSelectForm(kelurahan_form);
  axios({
    method : 'get',
    url : 'localhost:8080/api/kota-kabupaten/by-provinsi/'+val,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach(item => {
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
  getChildrenData('kota-kabupaten',val)
  clearSelectForm(kecamatan_form);
  clearSelectForm(kelurahan_form);
  axios({
    method : 'get',
    url : 'localhost:8080/api/kecamatan/by-kota-kabupaten/'+val,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach(item => {
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
  getChildrenData('kecamatan',val)
  axios({
    method : 'get',
    url : 'localhost:8080/api/kelurahan/by-kecamatan/'+val,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach(item => {
      var option = document.createElement('option');
      option.value = item.id;
      option.innerHTML = item.kelurahan;
      kelurahan_form.appendChild(option);
    });
  });
}

function graphStatus(type,id) {
  axios({
    method : 'get',
    url : 'localhost:8080/status-stunting/'+type+'/'+id,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    let new_data = [
      response.data.status_sangat_dibawah,
      response.data.status_dibawah,
      response.data.status_normal,
      response.data.status_diatas
    ]
    console.log(new_data)
    myChart.data.datasets[0].data = new_data
    // console.log('asdasd '+myChart.data.datasets.data)
    myChart.update()
  })
}

