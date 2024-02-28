<nav class="flex justify-between items-center mb-4">
    <a href="" class="flex p-2">
        <img class="w-20" src="{{URL('images/city.png')}}" alt="" class="logo"/>
    </a>
    <div class="flex">
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