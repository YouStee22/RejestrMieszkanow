<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="./images/city.png" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
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
        <title>RM | Find People City & Families</title>
    </head>
    @include('shared.login')
    <body class="mb-48">
 
        <section
        class="relative h-72 bg-blue-500 flex flex-col justify-center align-center text-center space-y-4 mb-4"
    >
        <div
            class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
            style="background-image: url('{{URL('images/Document.png')}}')"
        ></div>
        <p class="text-4xl text-gray-200 font-bold my-4">
            {{__('welcome.dst')}}
        </p>
        <div class="z-10">
            <div>
                <p class="text-lg text-gray-200 font-bold ">
                    {{__('welcome.secOne')}}
                </p>
               
            </div>
            <div class="flex justify-center items-center">
                <div class="hidden bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mt-6 max-w-96" id="alertUnlogged" role="alert">
                    <p class="font-bold"> {{__('welcome.att')}}</p>
                    <p> {{__('welcome.mstFi')}}</p>
                  </div>
            </div>
        </div>
    </section>
    <a href="{{ url(app()->getLocale() == 'pl'? 'pl/hello' : 'en/hello')}}" class="inline-block text-black ml-4 mb-4"
    ><i class="fa-solid fa-arrow-left"></i>  {{__('welcome.bck')}}</a>

        <main>
            <div class="lg:grid xl:grid-cols-3 gap-2 space-y-2 md:space-y-0 mx-4 items-center">

                        <div class="bg-gray-50 border border-gray-200 rounded p-6">
                            <div class="flex">
                                <img
                                    class="hidden w-48 mr-6 md:block"
                                    src="{{URL('images/Document.png')}}"
                                    alt=""/>
                                <div>
                                    <h3 class="text-2xl">
                                        <a>{{__('welcome.addCity')}}</a>
                                    </h3>
                                    <div class="text-xl font-bold mb-4">{{__('welcome.rF')}}<br>
                                        <span class=" text-xs text-red-400/50">{{__('welcome.av')}}</span>
                                    </div>
                                    @if (Route::has('login'))
                                        <button onclick="veryficationIfUserLogged(1)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                            {{__('welcome.buyDoc')}}
                                        </button><br>
                                        <ul class="flex mt-4">
                                            <li
                                                class="flex items-center justify-center bg-slate-700 text-white rounded-xl py-1 px-3 mr-2 text-xs"
                                            >
                                                <a href="{{route('getFormularzMiasto')}}">{{__('welcome.pric1')}}</a>
                                            </li>
                                            <li
                                                class="flex items-center justify-center bg-green-500 text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                                <a href="#">Available</a>
                                            </li>               
                                        </ul>
                                   @endif
                                </div>
                            </div>
                        </div>



                         <div class="bg-gray-50 border border-gray-200 rounded p-6">
                            <div class="flex">
                                <img
                                    class="hidden w-48 mr-6 md:block"
                                    src="{{URL('images/Document.png')}}"
                                    alt=""
                                />
                                <div> 
                                    <h3 class="text-2xl">
                                        <a href="miasta.html">{{__('welcome.addFamily')}}</a>
                                    </h3>
                                    <h3 class="text-2xl">
                                        <a href="formularzGlowny.html"></a>
                                    </h3>
                                    <div class="text-xl font-bold mb-4">{{__('welcome.rF')}}<br> <span class=" text-xs text-red-400/50">Dostępny z uprawnieniami</span></div>
                                    @if (Route::has('login'))
                                        <button onclick="veryficationIfUserLogged(2)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                                            {{__('welcome.buyDoc')}}
                                        </button>
                                      <ul class="flex mt-4">
                                        <li
                                            class="flex items-center justify-center bg-slate-700 text-white rounded-xl py-1 px-3 mr-2 text-xs"
                                        >
                                            <a href="">{{__('welcome.prc2')}}</a>
                                        </li>
                                        <li
                                            class="flex items-center justify-center bg-green-500 text-white rounded-xl py-1 px-3 mr-2 text-xs">
                                            <a href="#">Available</a>
                                        </li>               
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded p-6">
                            <div class="flex">
                                <img
                                    class="hidden w-48 mr-6 md:block"
                                    src="{{URL('images/Document.png')}}"
                                    alt=""/>
                                <div>
                                    <h3 class="text-2xl">
                                        <a href="">{{__('welcome.addpers')}}</a>
                                    </h3>
                                    <div class="text-xl font-bold mb-4">{{__('welcome.rF')}}<br> <span class=" text-xs text-green-400/50">{{__('welcome.withPut')}}</span></div>
                                    <a href="{{route('addPerson')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-full">
                                        {{__('welcome.buyDoc')}}
                                    </a>
                                </div>
                            </div>
                        </div>
            </div>
        </main>

        @include('shared.footer')


    <script>
    

        



        function veryficationIfUserLogged(number) {
            console.log(number)
                if (document.querySelector('.login') !== null  ||  document.querySelector('.register') !== null) {
                    document.querySelector('#alertUnlogged').classList.remove("hidden");

                    setTimeout(function() {
                        document.querySelector('#alertUnlogged').classList.add("hidden");
                    }, 3000);

                    return false;
                };
                if (document.querySelector('.dashboard') !== null) {
                    console.log('Poblem1')
                    if (number == 1) 
                        window.location.href = "{{route('getFormMiasto', ['102400', 'true'])}}";
                    else 
                        window.location.href = "{{route('getFormMiasto', ['51200', 'false'])}}"; 
                };
            }
            

    </script>
    </body>
</html>
