@extends('app')
@section('title','Dashboard')
@section('container')

@include('partials.titlePage',['title' => 'Dashboard'])

<div class="flex flex-wrap">
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <!--Metric Card-->
        <div class="bg-swhite border-t-8 border-secondary rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="w-24 pr-4 text-center">
                    <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-secondary">Total Pengguna</h5>
                    <h3 class="font-bold text-3xl">{{ $data->user }} </h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <!--Metric Card-->
        <div class="bg-swhite border-t-8 border-secondary rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="w-24 pr-4 text-center">
                    <div class="rounded-full p-5 bg-green-600"><i class="fas fa-user-md fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-secondary">Total Nakes</h5>
                    <h3 class="font-bold text-3xl">{{ $data->nakes }}</h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <!--Metric Card-->
        <div class="bg-swhite border-t-8 border-secondary rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="w-24 pr-4 text-center">
                    <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-hands-helping fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-secondary">Total Kader</h5>
                    <h3 class="font-bold text-3xl">{{ $data->kader }}</h3>
                </div>
                </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <!--Metric Card-->
        <div class="bg-swhite border-t-8 border-secondary rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="w-24 pr-4 text-center">
                    <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-female fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-secondary">Total Ibu Terdaftar</h5>
                    <h3 class="font-bold text-3xl">{{ $data->mother }}</h3>
                    </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <!--Metric Card-->
        <div class="bg-swhite border-t-8 border-secondary rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="w-24 pr-4 text-center">
                    <div class="rounded-full p-5 bg-red-600"><i class="fas fa-child fa-2x fa-inverse"></i></div>
                </div>
            <div class="flex-1 text-right md:text-center">
                <h5 class="font-bold uppercase text-secondary">Total Anak Terdaftar</h5>
                    <h3 class="font-bold text-3xl">{{ $data->children }}</h3>
            </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <!--Metric Card-->
        <div class="bg-swhite border-t-8 border-secondary rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="w-24 pr-4 text-center">
                    <div class="rounded-full p-5 bg-indigo-600"><i class="fas fa-newspaper fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-secondary">Artikel Terbuat</h5>
                    <h3 class="font-bold text-3xl">{{ $data->article }}</h3>
                </div>
            </div>
        </div>
        <!--/Metric Card-->
    </div>
    
</div>
<input type="hidden" name="status_sangat_dibawah" id="status_sangat_dibawah" value="{{ $data->status_sangat_dibawah }}">
<input type="hidden" name="status_dibawah" id="status_dibawah" value="{{ $data->status_dibawah }}">
<input type="hidden" name="status_normal" id="status_normal" value="{{ $data->status_normal }}">
<input type="hidden" name="status_diatas" id="status_diatas" value="{{ $data->status_diatas }}">
<div class="flex flex-wrap justify-center items-center">
    <div class="w-1/2 bg-swhite px-16 rounded-xl border-t-8 shadow-xl border-secondary">
        <h2 class="text-2xl text-center font-medium mt-8">Grafik Status Data Kembang</h2>
        <div class="p-6">
            <canvas class="" id="report-chart" width="undefined" height="undefined"></canvas>
        </div>
    </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
<script>
    const sangat_dibawah = document.getElementById('status_sangat_dibawah').value
    const dibawah = document.getElementById('status_dibawah').value
    const normal = document.getElementById('status_normal').value
    const diatas = document.getElementById('status_diatas').value
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
                sangat_dibawah,
                dibawah,
                normal,
                diatas
            ],
            backgroundColor: [
                '#b30000',
                '#1a53ff',
                '#5ad45a',
                '#ebdc78',
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

    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
    document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
    var input, filter, ul, li, a, i;
    input = document.getElementById(myDropMenuSearch);
    filter = input.value.toUpperCase();
    div = document.getElementById(myDropMenu);
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
    if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
        var dropdowns = document.getElementsByClassName("dropdownlist");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (!openDropdown.classList.contains('invisible')) {
                openDropdown.classList.add('invisible');
            }
        }
    }
    }
</script>
@endsection