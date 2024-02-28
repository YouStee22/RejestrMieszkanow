<nav class="flex justify-between items-center mb-4">
    <a href="" class="flex p-2">
        <img class="w-20" src="{{URL('images/city.png')}}" alt="" class="logo"/>
    </a>
    <div class="flex">
        <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="flex mr-5 mt-6 font-bold text-gray-400" type="button">
            {{app()->getLocale() == 'pl'? 'Polish🇵🇱' : 'English🇬🇧'}}<svg class="ml-2 h-4 w-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </button>
          <div id="dropdown" class="hidden z-10 block w-44 divide-y divide-gray-400 rounded bg-white shadow dark:bg-gray-500" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(327px, 70px, 0px);">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-600" aria-labelledby="dropdownDefault">
              <li>
                <a href="{{ url(app()->getLocale() == 'pl'? 'en/hello' : 'pl/hello')}}" class="block py-2 px-4 hover:bg-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"><b>{{ app()->getLocale() == 'pl' ? 'English🇬🇧' : 'Polish🇵🇱'}}</b></a>
              </li>
            </ul>
          </div>
          <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
        @if (Route::has('login'))
        <div class=" sm:top-0 sm:right-0 p-6 text-right z-10" id="logged">
            @auth
                <a href="{{ route('dashboard') }}" class="dashboard font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{__('welcome.panel')}}</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 login">{{__('welcome.log')}}</a>
            
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 register">{{__('welcome.registry')}}</a>                
                @endif
            @endauth
        </div>
    </div>
@endif
</nav>