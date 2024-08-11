// const local_url = process.env.APP_URL;
// const url = 'http://167.172.85.4'
var rows = document.querySelectorAll("[id^=row_]")
var buttons = document.querySelectorAll('[id^=data_children_update_btn_')
async function newDataChildren(last_row_id) {
  const panjangBadan = parseFloat(document.getElementById('panjang_badan').value);
  const beratBadan = parseFloat(document.getElementById('berat_badan').value);
  
  if (panjangBadan < 0) {
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan !',
      text: 'Panjang Badan Anak Negatif',
      confirmButtonColor: '#3085d6',
    });
    return;
  }

  if (beratBadan > 1000) {
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan !',
      text: 'Berat badan terlalu besar, pastikan dalam kilogram',
      confirmButtonColor: '#3085d6'
    });
    return;
  }

  var data = {
    children_id : document.getElementById('childrenId').value,
    tanggal : document.getElementById('tanggal').value,
    bulan_ke : document.getElementById('bulan_ke').value,
    tempat : document.getElementById('tempat').value,
    berat_badan : beratBadan,
    panjang_badan : panjangBadan
  }

  var response = await fetch(local_url+'/data-children/add',{
    method: 'POST',
    headers: {
      'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest"
    },
    credentials: "same-origin",
    body: JSON.stringify(data)
  })
  var result = await response.json()
  Swal.fire({
    icon: 'success',
    text: 'Data Anak Berhasil Ditambah',
    confirmButtonColor: '#3085d6',
  }).then(() => location.reload())
}

async function updateDataChildren(id) {
  const panjangBadan = parseFloat(document.getElementById('panjang_badan').value);
  const beratBadan = parseFloat(document.getElementById('berat_badan').value);
  
  if (panjangBadan < 0) {
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan !',
      text: 'Panjang Badan Anak Negatif',
      confirmButtonColor: '#3085d6',
    });
    return;
  }

  if (beratBadan > 100) {
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan !',
      text: 'Berat badan terlalu besar, pastikan dalam kilogram',
      confirmButtonColor: '#3085d6'
    });
    return;
  }
  var data = {
    children_id : document.getElementById('childrenId').value,
    id : document.getElementById('data_children_id_'+id).value,
    tanggal : document.getElementById('tanggal_'+id).value,
    bulan_ke : document.getElementById('bulan_ke_'+id).value,
    tempat : document.getElementById('tempat_'+id).value,
    berat_badan : document.getElementById('berat_badan_'+id).value,
    panjang_badan : document.getElementById('panjang_badan_'+id).value
  }
  var response = await fetch(local_url+'/data-children/update',{
    method: 'POST',
    headers: {
      'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest"
    },
    credentials: "same-origin",
    body: JSON.stringify(data)
  })
  var result = await response.json()
  Swal.fire({
    icon: 'success',
    text: 'Data Anak Berhasil Diubah',
    confirmButtonColor: '#3085d6',
  }).then(() => location.reload())
  // document.getElementById('tanggal_'+id).value = result.data.tanggal
  // document.getElementById('bulan_ke_'+id).value = result.data.bulan_ke
  // document.getElementById('tempat_'+id).value = result.data.tempat
  // document.getElementById('berat_badan_'+id).value = result.data.berat_badan
  // document.getElementById('panjang_badan_'+id).value = result.data.panjang_badan
}

async function updateStatusChildren() {
  var data = {
    id : document.getElementById('status_children_id').value,
    status_children : document.getElementById('status_children').value
  }
  var response = await fetch(local_url+'/status-stunting/update',{
    method: 'POST',
    headers: {
      'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest"
    },
    credentials: "same-origin",
    body: JSON.stringify(data)
  })
  var result = await response.json()
    .then((res) => {
      if (res.message == 'Data Berhasil Diubah') {
        Swal.fire('Status Anak Berhasil Diubah','','success')
        .then(() => location.reload())
      }
    })
}