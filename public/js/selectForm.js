// const api_url = process.env.API_URL;
function clearSelectForm(element) {
  while (element.childElementCount > 1) {          
    element.removeChild(element.lastChild);
  }
}
// var account_type = ''

// function getType(){
// }

// window.onload = getType();

function provinsi(val) {
  let type = document.querySelector('[id*="-table"]').id.replace('-table','');
  let kota_kab_form = document.getElementById('kota_kabupaten_id');
  let kecamatan_form = document.getElementById('kecamatan_id');
  let kelurahan_form = document.getElementById('kelurahan_id');
  clearSelectForm(kota_kab_form);
  clearSelectForm(kecamatan_form);
  clearSelectForm(kelurahan_form);
  switch (type) {
    case 'mother':
      getMothersData('provinsi',val);
      break;
    case 'nakes':
      getNakesData('provinsi',val);
      break;
    case 'kader':
      getKaderData('provinsi',val);
      break;

    default:
      break;
  }
  axios({
    method : 'get',
    url : api_url+'kota-kabupaten/by-provinsi/'+val,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach(item => {
        let option = document.createElement('option');
        option.value = item.id;
        option.innerHTML = item.kota_kabupaten;
        kota_kab_form.appendChild(option);
      });
  });
}

function kotaKab(val) {
  let type = document.querySelector('[id*="-table"]').id.replace('-table','');
  let kecamatan_form = document.getElementById('kecamatan_id');
  let kelurahan_form = document.getElementById('kelurahan_id');
  clearSelectForm(kecamatan_form);
  clearSelectForm(kelurahan_form);
  switch (type) {
    case 'mother':
      getMothersData('kota-kabupaten',val);
      break;
    case 'nakes':
      getNakesData('kota-kabupaten',val);
      break;
    case 'kader':
      getKaderData('kota-kabupaten',val);
      break;

    default:
      break;
  }
  axios({
    method : 'get',
    url : api_url+'kecamatan/by-kota-kabupaten/'+val,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach(item => {
      let option = document.createElement('option');
      option.value = item.id;
      option.innerHTML = item.kecamatan;
      kecamatan_form.appendChild(option);
    });
  });
}

function kecamatan(val) {
  let type = document.querySelector('[id*="-table"]').id.replace('-table','');
  let kelurahan_form = document.getElementById('kelurahan_id');
  clearSelectForm(kelurahan_form);
  switch (type) {
    case 'mother':
      getMothersData('kecamatan',val);
      break;
    case 'nakes':
      getNakesData('kecamatan',val);
      break;
    case 'kader':
      getKaderData('kecamatan',val);
      break;

    default:
      break;
  }
  axios({
    method : 'get',
    url : api_url+'kelurahan/by-kecamatan/'+val,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach(item => {
      let option = document.createElement('option');
      option.value = item.id;
      option.innerHTML = item.kelurahan;
      kelurahan_form.appendChild(option);
    });
  });
}

function kelurahan(val) {
  let type = document.querySelector('[id*="-table"]').id.replace('-table','');
  let kelurahan_form = document.getElementById('kelurahan_id');
  switch (type) {
    case 'mother':
      getMothersData('kelurahan',val);
      break;
    case 'nakes':
      getNakesData('kelurahan',val);
      break;
    case 'kader':
      getKaderData('kelurahan',val);
      break;

    default:
      break;
  }
  axios({
    method : 'get',
    url : api_url+'kelurahan/by-kecamatan/'+val,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach(item => {
      let option = document.createElement('option');
      option.value = item.id;
      option.innerHTML = item.kelurahan;
      kelurahan_form.appendChild(option);
    });
  });
}

