<tr class="bg-green-100">
  <td class="p-2 border-2 border-green-400">
    <input
      class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
      type="number"
      name="bulan_ke" id="bulan_ke" value="{{ $bulan_ke}}">
  </td>
  <td class="p-2 border-2 border-green-400">
    <input 
      class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
      type="date"
      name="tanggal" id="tanggal" placeholder="Tanggal" value="">
  </td>
  <td class="p-2 border-2 border-green-400">
    <input 
      class="w-full rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
      type="text"
      name="tempat" id="tempat" placeholder="Tempat" value="">
  </td>
  <td class="p-2 border-2 border-green-400">
    <input 
      class="w-3/4 rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
      type="number"
      min="0"
      step="0.1"
      name="panjang_badan" id="panjang_badan" placeholder="PB" value="">
      cm
  </td>
  <td class="p-2 border-2 border-green-400">
    <input 
      class="w-3/4 rounded-md border text-lg py-2 shadow-md focus:outline-none focus:ring-2 ring-blue-400"
      type="number"
      min="0"
      step="0.1"
      name="berat_badan" id="berat_badan" placeholder="BB" value="">
      kg
  </td>
  <td class="p-2 border-2 border-green-400">
    <button
      class="w-full font-medium border-2 border-secondary bg-[#06CA51] hover:bg-secondary hover:text-primary py-2 rounded-md object-center transform duration-300"
      id="data_children_add" name="add-data"
      onclick="newDataChildren({{ $last_row }})">
      Tambah Data
    </button>
  </td>
</tr>