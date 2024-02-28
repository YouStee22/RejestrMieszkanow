<section
class="relative h-72 bg-blue-500 flex flex-col justify-center align-center text-center space-y-4 mb-4"
>
<div
    class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
    style="background-image: url('{{asset('images/city.png')}}');"
></div>

<div class="z-10 ">
    <h1 class="text-5xl font-bold uppercase text-white">
        {{__('welcome.register')}} <span class="text-black">{{__('welcome.r2')}}</span>
    </h1>
    <p class="text-2xl text-gray-200 font-bold my-4">
        {{__('welcome.info')}}
    </p>
    <div>
        <p class="text-lg text-gray-200 font-bold ">
            {{__('welcome.types')}}
        </p>
        <a href="{{ route('formularz') }}"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
            >{{__('welcome.buttForm')}}</a>
    </div>
</div>
</section>
