@yield('content')


<div class="bg-gray-50 border border-gray-200 rounded p-6">
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{ URL::to('/images/city2.png') }}"
            alt=""
        />
        <div>
            <h3 class="text-3xl">
                <a href="{{ route('goMiasta') }}">{{__('welcome.cities')}}</a>
            </h3>
            <div class="text-md font-bold mb-4">{{__('welcome.all_cities')}}</div>
            <ul class="flex">
                <li
                    class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                >
                    <a href="#">{{__('welcome.colonies')}}</a>
                </li>
                <li
                    class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    <a href="#">{{__('welcome.cities')}}</a>
                </li>
                <li
                    class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
                    <a href="#">{{__('welcome.villages')}}</a>
                </li>

                
            </ul>
             <div class="text-lg mt-4">
                {{-- @if (!Auth::check())
                    <span class=" text-xs text-red-400/50">Wymaga logowania</span>
                @endif --}}
            </div>
        </div>
    </div>
</div>



         <!-- Item 1 -->
         <div class="bg-gray-50 border border-gray-200 rounded p-6">
            <div class="flex">
                <img
                    class="hidden w-48 mr-6 md:block"
                    src="{{ URL::to('/images/family.png') }}"
                    alt=""
                />
                <div>
                    <h3 class="text-3xl">
                        <a href="{{ route('getFamilies') }}">{{__('welcome.families')}}</a>
                    </h3>
                    <div class="text-md font-bold mb-4">{{__('welcome.all_families')}}</div>
                    <ul class="flex">
                        <li
                            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                        >
                            <a href="#">{{__('welcome.smFamilies')}}</a>
                        </li>
                        <li
                            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                        >
                            <a href="#">{{__('welcome.mdFamiles')}}</a>
                        </li>
        
                    </ul>
                    <div class="text-lg mt-4">
                        {{-- @if (!Auth::check())
                            <span class=" text-xs text-red-400/50">Wymaga logowania</span>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 border border-gray-200 rounded p-6">
            <div class="flex">
                <img
                    class="hidden w-48 mr-6 md:block"
                    src="{{ URL::to('/images/person.png') }}"
                    alt=""/>
                <div>
                    <h3 class="text-3xl">
                        <a href="{{ route('goOsoby') }}">{{__('welcome.persons')}}</a>
                    </h3>
                    <div class="text-md font-bold mb-4">{{__('welcome.all_persons')}}</div>
                    <ul class="flex">
                        <li
                            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                        >
                            <a href="#">{{__('welcome.prData')}}</a>
                        </li>
                        <li
                            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                        >
                            <a href="#">{{__('welcome.prPesel')}}</a>
                        </li>
                    </ul>
                    <div class="text-lg mt-4">
                        
                       
                       
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="bg-gray-50 border border-gray-200 rounded p-6">
            <div class="flex">
                <img
                    class="hidden w-48 mr-6 md:block"
                    src="images/person.png"
                    alt=""/>
                <div>
                    <h3 class="text-3xl">
                        <a href="osoby.html">Osoby</a>
                    </h3>
                    <div class="text-md font-bold mb-4">Nieprzypisane do rodzin</div>
                    <ul class="flex">
                        <li
                            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                        >
                            <a href="#">Rodziny małe</a>
                        </li>
                        <li
                            class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
                        >
                            <a href="#">Rodzin duze</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}

</div>

