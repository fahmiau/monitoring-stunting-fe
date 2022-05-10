function clearSelectForm(element) {
  if (element.childElementCount > 1) {
    while (element.childElementCount > 1) {          
      element.removeChild(element.lastChild);
    }
  }
}

function provinsi() {
  var provinsi_form = document.getElementById('provinsi_id');
  fetch('http://127.0.0.1:8000/api/provinsi/all')
    .then(response => response.json())
    .then((res) => {
      res.forEach(item => {
        var option = document.createElement('option');
        option.value = item.id;
        option.innerHTML = item.provinsi;
        provinsi_form.appendChild(option);
      });
    });
}

function findKotaKab(val) {
  var kota_kab_form = document.getElementById('kota_kabupaten_id');
  var kelurahan_form = document.getElementById('kelurahan_id');
  var kecamatan_form = document.getElementById('kecamatan_id');
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

function findKecamatan(val) {
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

function findKelurahan(val) {
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