<nav class="bg-white shadow-xl pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

    <div class="flex flex-wrap items-center">
        <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white pl-8">
            <img class="object-cover max-h-9" src="{{ asset('img/icons/cegah_stunting_logo_2.jpg') }}" alt="">
        </div>
  
        <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
            <span class="relative w-full">
                {{-- <input type="search" placeholder="Search" class="w-full bg-gray-900 text-gray-800 transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">
                <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
                    <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                    </svg>
                </div> --}}
            </span>
        </div>
  
        <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
            <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                <li class="flex-1 md:flex-none md:mr-3">
                    <a class="inline-block text-gray-800 no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="{{ route('logout') }}">Logout</a>
                </li>
                <li class="flex-1 md:flex-none md:mr-3">
                    <div class="relative inline-block">
                        <span class="pr-4"><i class="em em-robot_face"></i></span> {{ strtok(Session::get('user_data')->name,' ') }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
  
  </nav>
  
  
  <div class="flex flex-col md:flex-row">
  
    <div class="bg-secondary  h-16 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48">
  
        <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
            <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
                <li id="home" class="mr-3 flex-1">
                    <a href="{{ url('/') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-100 no-underline hover:text-gray-100 border-b-2 hover:border-primary {{ Request::is('/') ? 'border-blue-600' : 'border-gray-800' }} ">
                        <i class="fas fa-tasks pr-0 md:pr-3 {{ Request::is('/') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-100 block md:inline-block">Dashboard</span>
                    </a>
                </li>
                <li id="account" class="mr-3 flex-1">
                    <a href="{{ url('/list-account') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-100 no-underline hover:text-gray-100 border-b-2 hover:border-primary  {{ Request::is('list-account*') ? 'border-blue-600' : 'border-gray-800' }}">
                        <i class="fa fa-envelope pr-0 md:pr-3 {{ Request::is('list-account*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-600 md:text-gray-100 block md:inline-block">Daftar Akun</span>
                    </a>
                </li>
                <li id="article" class="mr-3 flex-1">
                    <a href="{{ url('/article/list') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-100 no-underline hover:text-gray-100 border-b-2 hover:border-primary  {{ Request::is('article*') ? 'border-blue-600' : 'border-gray-800' }}">
                        <i class="fas fa-chart-area pr-0 md:pr-3 {{ Request::is('article*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-100 md:text-gray-100 block md:inline-block">Artikel</span>
                    </a>
                </li>
                <li id="report" class="mr-3 flex-1">
                    <a href="{{ url('/report') }}" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-gray-100 no-underline hover:text-gray-100 border-b-2 hover:border-primary {{ Request::is('report*') ? 'border-blue-600' : 'border-gray-800' }}">
                        <i class="fa fa-wallet pr-0 md:pr-3 {{ Request::is('report*') ? 'text-blue-600' : '' }}"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-100 md:text-gray-100 block md:inline-block">Report</span>
                    </a>
                </li>
            </ul>
        </div>
  
  
    </div>

    <script>

    </script>