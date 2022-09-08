var rows = document.querySelectorAll("[id^=row_]")
var buttons = document.querySelectorAll('[id^=data_children_update_btn_')
async function newDataChildren(last_row_id) {
  var data = {
    children_id : document.getElementById('childrenId').value,
    tanggal : document.getElementById('tanggal').value,
    bulan_ke : document.getElementById('bulan_ke').value,
    tempat : document.getElementById('tempat').value,
    berat_badan : document.getElementById('berat_badan').value,
    panjang_badan : document.getElementById('panjang_badan').value
  }
  // Swal.fire({
  //   icon: 'error',
  //   title: 'Oops...',
  //   text: 'Something went wrong!',
  //   footer: '<a href="">Why do I have this issue?</a>'
  // })
  // console.log(data)
  // console.log(JSON.stringify(data))
  var response = await fetch('http://167.172.85.4/data-children/add',{
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
  Swal.fire('Data Anak Berhasil Ditambah','','success')
    .then(() => location.reload())
  // var table = document.getElementById('data-children-table')
  // var last_row = document.getElementById('row_'+last_row_id)
  // var new_row = table.insertRow((last_row_id == 1) ? 0 : 1)
  // new_row.setAttribute('id','row_'+(last_row_id+1))
  // new_row.innerHTML += 
  //     '<td class="px-2 py-1 border-2 border-blue-400">'+
  //       '<input type="hidden" name="data_children_id_'+(last_row_id+1)+'" id="data_children_id_'+(last_row_id+1)+'" value="'+result.data.id+'">'+
  //       '<input '+
  //         'class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"'+
  //         'type="number"'+
  //         'name="bulan_ke_'+(last_row_id+1)+'"'+
  //         'id="bulan_ke_'+(last_row_id+1)+'"'+
  //         'value="'+data.bulan_ke+'">'+
  //     '</td>'+
  //     '<td class="px-2 py-1 border-2 border-blue-400">'+
  //       '<input '+
  //         'class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"'+
  //         'type="date"'+
  //         'name="tanggal_'+(last_row_id+1)+'"'+
  //         'id="tanggal_'+(last_row_id+1)+'" placeholder="Tanggal"'+
  //         'value="'+ data.tanggal +'">'+
  //     '</td>'+
  //     '<td class="px-2 py-1 border-2 border-blue-400">'+
  //       '<input '+
  //         'class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"'+
  //         'type="text"'+
  //         'name="tempat_'+(last_row_id+1)+'"'+
  //         'id="tempat_'+(last_row_id+1)+'" placeholder="Tempat"'+
  //         'value="'+ data.tempat +'">'+
  //     '</td>'+
  //     '<td class="px-2 py-1 border-2 border-blue-400">'+
  //       '<input '+
  //         'class="w-3/4 rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"'+
  //         'type="number"'+
  //         'min="0"'+
  //         'step="0.1"'+
  //         'name="panjang_badan_'+(last_row_id+1)+'"'+
  //         'id="panjang_badan_'+(last_row_id+1)+'"'+
  //         'value="'+ data.panjang_badan +'">'+
  //       ' cm'+
  //     '</td>'+
  //     '<td class="px-2 py-1 border-2 border-blue-400">'+
  //       '<input '+
  //         'class="w-3/4 rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"'+
  //         'type="number"'+
  //         'min="0"'+
  //         'step="0.1"'+
  //         'name="berat_badan_'+(last_row_id+1)+'"'+
  //         'id="berat_badan_'+(last_row_id+1)+'"'+
  //         'value="'+ data.berat_badan +'"/>'+
  //       ' kg'+
  //     '</td>'+
  //     '<td class="p-2 border-2 border-blue-400">'+
  //       '<button '+
  //         'id="data_children_update_btn_'+(last_row_id+1)+'"'+
  //         'onclick="updateDataChildren('+(last_row_id+1)+')"'+
  //         'class="w-full font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300">'+
  //         'EDIT'+
  //       '</button>'+
  //     '</td>'
  // console.log(last_row)
  // document.getElementById('childrenId').value = ''
  // document.getElementById('tanggal').value = ''
  // document.getElementById('bulan_ke').value = ''
  // document.getElementById('tempat').value = ''
  // document.getElementById('berat_badan').value = ''
  // document.getElementById('panjang_badan').value = ''


    // .then((response) => response.json())
    // .then((data) => console.log(data))
    // .catch((error) => {
    //   console.log(error)
    // })
    
}

async function updateDataChildren(id) {
  var data = {
    children_id : document.getElementById('childrenId').value,
    id : document.getElementById('data_children_id_'+id).value,
    tanggal : document.getElementById('tanggal_'+id).value,
    bulan_ke : document.getElementById('bulan_ke_'+id).value,
    tempat : document.getElementById('tempat_'+id).value,
    berat_badan : document.getElementById('berat_badan_'+id).value,
    panjang_badan : document.getElementById('panjang_badan_'+id).value
  }
  var response = await fetch('http://167.172.85.4/data-children/update',{
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
  Swal.fire('Data Anak Berhasil Diubah','','success')
    .then(() => location.reload())
  // document.getElementById('tanggal_'+id).value = result.data.tanggal
  // document.getElementById('bulan_ke_'+id).value = result.data.bulan_ke
  // document.getElementById('tempat_'+id).value = result.data.tempat
  // document.getElementById('berat_badan_'+id).value = result.data.berat_badan
  // document.getElementById('panjang_badan_'+id).value = result.data.panjang_badan
}