<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Witaj na profilu ') }} {{ Auth::user()->name }}!
            
            
            <div class="mt-5">
                Kiedyś tutaj będzie wspaniały teskt! na razie...
            </div>
               

        
            <br>
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="{{ url(app()->getLocale() == 'pl'? 'pl/hello' : 'en/hello')}}">Wróć na stronę główną!</a>
       
            <form method="POST" action="{{ route('logout') }}" x-data class="mt-5">
                @csrf

                <x-dropdown-link href="{{ route('logout') }}"
                         @click.prevent="$root.submit();">
                    {{ __('Wyloguj się') }}
                </x-dropdown-link>
            </form>
        
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
