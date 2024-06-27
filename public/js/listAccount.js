// const local_url = process.env.APP_URL;

// const url = 'http://167.172.85.4'
// function getAccountData(category,daerah,daerah_id) {
//   var data_table = document.getElementById(category+'-table')
//   while (data_table.childElementCount > 0) {
//     data_table.removeChild(data_table.lastChild)
//   }
//   axios({
//     method : 'get',
//     url : local_url+'/'+category+'/all/by-'+daerah+'/'+daerah_id,
//     headers : {
//       'Accept' : 'application/json'
//     }
//   })
//   .then(response => {
//     response.data.forEach((data,index) => {
//       const tr = document.createElement('tr')
//       var childrensHtml = ''
//       data.childrens.forEach(children => {
//           childrensHtml += '<div>'+
//           '<a class="underline hover:no-underline" href="'+local_url+'/children/detail/'+children.id+'">'+children.nama+'</a>'+
//           '</div>'
//         })
//       var statusHtml = ''
//       data.childrens.forEach(children => {
//         statusHtml += '<div>'+
//         ((!children.status_children) ? 'Data Belum Cukup' : children.status_children.status_stunting)+
//         '</div>'
//       })
//       tr.innerHTML =
//         '<td class="border border-blue-400 text-center">'+(index+1)+'</td>'+
//         '<td class="border border-blue-400 p-2">'+data.nam+'</td>'+
//         '<td class="border border-blue-400 p-2">'+
//         childrensHtml+
//         '</td>'+
//         '<td class="border border-blue-400 p-2">'+
//         statusHtml+
//         '</td>'     
//       children_table.appendChild(tr)
//     })
//   })
// }
function getMothersData(daerah,daerah_id) {
  var mother_table = document.getElementById('mother-table');
  while (mother_table.childElementCount > 0) {
    mother_table.removeChild(mother_table.lastChild)
  }
  axios({
    method : 'get',
    url : local_url+'/mother/all/by-'+daerah+'/'+daerah_id,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach((mother,index) => {
      const tr = document.createElement('tr')
      var childrensHtml = ''
      if (mother.childrens) {
        
        mother.childrens.forEach(children => {
          childrensHtml += '<div>'+
          '<a class="underline hover:no-underline" href="'+local_url+'/children/detail/'+children.id+'">'+children.nama+'</a>'+
          '</div>'
        })
      }
      // var statusHtml = ''
      // mother.childrens.forEach(children => {
      //   statusHtml += '<div>'+
      //   ((!children.status_children) ? 'Data Belum Cukup' : children.status_children.status_stunting)+
      //   '</div>'
      // })
      tr.innerHTML =
        '<td class="border px-4 py-1">'+(index+1)+'</td>'+
        '<td class="border px-4 py-1">'+mother.nama+'</td>'+
        '<td class="border px-4 py-1">'+
        childrensHtml+
        '</td>'+
        '<td class="border px-4 py-1">'+
        mother.alamat+
        '</td>'+
        '<td class="border px-4 py-1">'+
        mother.kecamatan+
        '</td>'+
        '<td class="border px-4 py-1">'+
        mother.kelurahan+
        '</td>'+
        '<td class="border px-4 py-1 w-32">'+
          '<a'+
          ' class="inline-block text-center font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300 mr-1"'+
          ' href="'+local_url+'/account/mother/'+mother.id+'">'+
          '<i class="fas fa-pencil-alt"></i>'+
          '</a>'+
          '<button'+ 
            ' onclick="deleteAccount('+mother.id+')"'+
            ' class="bg-red-600 py-2 px-2 border-secondary border-2 rounded-md text-white hover:text-black"'+
            '>'+
            '<i class="fas fa-trash-alt"></i>'+
          '</button>'+
        '</td>'
      mother_table.appendChild(tr)
    })
  })
}

function getNakesData(daerah,daerah_id) {
  var nakes_table = document.getElementById('nakes-table');
  while (nakes_table.childElementCount > 0) {
    nakes_table.removeChild(nakes_table.lastChild)
  }
  axios({
    method : 'get',
    url : local_url+'/nakes/all/by-'+daerah+'/'+daerah_id,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach((nakes,index) => {
      const tr = document.createElement('tr')
      tr.innerHTML =
        '<td class="border px-4 py-1">'+(index+1)+'</td>'+
        '<td class="border px-4 py-1">'+nakes.name+'</td>'+
        '<td class="border px-4 py-1">'+nakes.nomor_telepon+'</td>'+
        '<td class="border px-4 py-1">'+nakes.category+'</td>'+
        '<td class="border px-4 py-1">'+nakes.kecamatan+'</td>'+
        '<td class="border px-4 py-1">'+nakes.kelurahan+'</td>'+
        '<td class="border px-4 py-1">'+nakes.tempat_kerja+'</td>'+
        '<td class="border px-4 py-1 w-32">'+
          '<a'+
          ' class="inline-block text-center font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300 mr-1"'+
          ' href="'+local_url+'/account/nakes/'+nakes.id+'">'+
          '<i class="fas fa-pencil-alt"></i> '+
          '</a>'+
          '<button'+ 
            ' onclick="deleteAccount('+nakes.id+')"'+
            ' class="bg-red-600 py-2 px-2 border-secondary border-2 rounded-md text-white hover:text-black"'+
            '>'+
            '<i class="fas fa-trash-alt"></i>'+
          '</button>'+
        '</td>'
      nakes_table.appendChild(tr)
    })
  })
}

function getKaderData(daerah,daerah_id) {
  var kader_table = document.getElementById('kader-table');
  while (kader_table.childElementCount > 0) {
    kader_table.removeChild(kader_table.lastChild)
  }
  axios({
    method : 'get',
    url : local_url+'/kader/all/by-'+daerah+'/'+daerah_id,
    headers : {
      'Accept' : 'application/json'
    }
  })
  .then(response => {
    response.data.forEach((kader,index) => {
      const tr = document.createElement('tr')
      tr.innerHTML =
        '<td class="border px-4 py-1">'+(index+1)+'</td>'+
        '<td class="border px-4 py-1">'+kader.name+'</td>'+
        '<td class="border px-4 py-1">'+kader.nomor_telepon+'</td>'+
        '<td class="border px-4 py-1">'+kader.alamat+'</td>'+
        '<td class="border px-4 py-1">'+kader.kecamatan+'</td>'+
        '<td class="border px-4 py-1">'+kader.kelurahan+'</td>'+
        '<td class="border px-4 py-1 w-32">'+
          '<a'+
          ' class="inline-block text-center font-medium border-2 border-secondary bg-[#aacfff] hover:bg-secondary hover:text-primary p-2 rounded-md object-center transform duration-300 mr-1"'+
          ' href="'+local_url+'/account/kader/'+kader.id+'">'+
          '<i class="fas fa-pencil-alt"></i> '+
          ' </a>'+
          '<button'+ 
            ' onclick="deleteAccount('+kader.id+')"'+
            ' class="bg-red-600 py-2 px-2 border-secondary border-2 rounded-md text-white hover:text-black"'+
            '>'+
            '<i class="fas fa-trash-alt"></i>'+
          '</button>'+
        '</td>'
      kader_table.appendChild(tr)
    })
  })
}

