<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="'images/city.png'" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
    <title>RM | Find People City & Families</title>    </head>
    <body class="mb-48">
        @include('shared.login')
        <form action="{{ route('searchMiasto') }}" method="post">  
            @csrf 
            <label for="default-search" class="mb-3 text-sm font-medium text-gray-900 sr-only dark:text-white">{{__('welcome.sch')}}</label>
            <div class="relative mx-12 mb-5">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input name="data" id="search" type="search" id="default-search" class="px-5 block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Wpisz nazwę miasta bądz id..." required>
                <button type="submit" class="text-white absolute end-2.5 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Szukaj</button>
            </div>
        </form>
       

        <div class="flex justify-between">
            <a href="{{ url(app()->getLocale() == 'pl'? 'pl/hello' : 'en/hello')}}" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> {{__('welcome.bck')}}
            </a>

            <div class="flex">

                <button id="dropdownDefault" data-dropdown-toggle="dropdown1" class="flex mr-7 font-bold" type="button">
                    {{__('welcome.sgr')}}<svg class="ml-2 h-4 w-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                  </button>
                  <!-- Dropdown menu -->
                  <div id="dropdown1" class="hidden z-10 block w-44 divide-y divide-gray-100 rounded bg-white shadow dark:bg-gray-500" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(327px, 70px, 0px);">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                      <li>
                        <a href="{{ route('goMiastaOdw') }}" onclick="" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('welcome.rvs')}}</a>
                      </li>
                      <li>
                        <a href="{{ route('goMiastaAlf') }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('welcome.alf')}}</a>
                      </li>
                      <li>
                        <a href="{{ route('goMiasta') }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{__('welcome.bgn')}}</a>
                      </li>
                    </ul>
                  </div>
                  <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
                <a onclick="goBack()"><i class="fa-solid fa-arrow-left px-2"></i></a>
                <a class="infoPages">1</a>
                <a onclick="goNext()" class="mr-8"><i class="fa-solid fa-arrow-right px-2"></i></a>
            </div>
        </div>
       

        <main>
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4" id="citiesDiv">
                @foreach($categories as $category)
                    
                <div class="elementDiv">
                    <div class="flex bg-gray-50 border border-gray-200 rounded p-6 justify-between whitespace-nowrap" id="{{ $category->id }}">
                        <div class="flex">
                            <img
                                class="hidden w-48 mr-6 md:block"
                                src="{{ $category->img }}"
                                alt=""
                            />
                            <div>
                                <h3 class="text-2xl">
                                    <a>{{ $category->nazwa }}</a>
                                </h3>
                                <div class="text-md font-bold mb-4">{{ $category->wojewodztwo }}</div>
                                <ul class="flex">
                                    <li
                                        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                                    >
                                        <a href="#">ID {{ $category->id }}</a>
                                    </li>
                                    <li
                                        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                                    >
                                        <a href="#">{{ $category->kod_pocztowy }}</a>
                                    </li>
                    
                                </ul>
                                <div class="text-lg mt-4">
                                    <i class="fa-solid fa-location-dot"></i> {{ $category->kraj }}
                                    
                                </div>
                            </div>
                        </div>
                        <div class="text-center sm:ml-10">
                            @if (Auth::check()) 
                            {{-- <a href="{{ url("/api/editMiasto/".$category->id)}}"> --}}
                                {{-- <a href="{{ url (app()->getLocale()"editMiasto/".$category->id))}}"> --}}
                                <a href="api/editMiasto/{{ $category->id }}">
                                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 2xl:py-2 2xl:px-4 rounded">
                                        {{__('welcome.edit')}}
                                    </button>
                                </a>
                                <form action="/api/deleteCity/{{ $category->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 2xl:py-2 2xl:px-4 rounded mt-1">
                                    {{__('welcome.del')}}
                                </button>
                                </form> 
                            @endif
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </main>

        <div class="mt-5 text-end">
            <div class="">
                <button onclick="goBack()"><i class="fa-solid fa-arrow-left"></i></button>
                <a class="infoPages">1</a>
                <button onclick="goNext()" class="mr-8"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>

        @include('shared.footer')


        <script>
            var pages = [];
            let accPage = 0;
            pagesDividerAlgorithm();



            function pagesDividerAlgorithm() { 
                let ele = [];
                let divs = document.querySelectorAll('.elementDiv');

                let pgAtx = 0;
                let obj = '';
                for (let i = 0; i < divs.length; i++) {
                    if ((i % 4 == 0)  &&  (i > 2)) {
                        pages.push(obj);
                        obj = '';
                    } 
                    obj += divs[i].innerHTML;
                }
                console.log(obj)
                pages.push(obj);

                document.querySelector('#citiesDiv').innerHTML = pages[accPage];
            
                document.querySelectorAll('.infoPages').forEach(element => {
                element.innerText = accPage + 1;
                });
            }

            function goBack() {
                if (accPage > 0) {
                    accPage--;
                    let pageNum = accPage + 1
                    document.querySelectorAll('.infoPages').forEach(element => {
                    element.innerText = pageNum;
                    });
                    document.querySelector('#citiesDiv').innerHTML = pages[accPage];
                }
            }

            function goNext() {
                if (accPage < pages.length - 1) {
                    accPage++;
                    let pageNum = accPage + 1
                    document.querySelectorAll('.infoPages').forEach(element => {
                    element.innerText = pageNum;
                    });
                    document.querySelector('#citiesDiv').innerHTML = pages[accPage];
                }
            }
        </script>
    </body>
</html>
