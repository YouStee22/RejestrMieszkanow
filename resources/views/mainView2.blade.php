<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="{{ URL('images/city.png') }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>

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


    <body class="mb-48">
      @include('shared.login')
        @include('shared.banner')
    

        <main>
            @extends('layouts.mainCode')
            @section('content')
           

            @endsection
        </main>
        @include('shared.footer')
                <div class="elfsight-app-b11220eb-2608-4113-a35a-3cdec706767f" data-elfsight-app-lazy></div>           

     
        <script src="{{ asset('js/checkIfLogged.js')}}"></script>
        <script>
            console.log(localStorage);
            let isUserLogged = veryficationIfUserLogged();

            // @if (Route::has('register'))
                //     <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 register">Zarejestruj</a>
                // @endif

            function veryficationIfUserLogged() {
                if (document.querySelector('.login') !== null  ||  document.querySelector('.register') !== null) {
                    console.log('Niezalogowany');



                    return false;
                };
                if (document.querySelector('.dashboard') !== null) {
                    console.log('Zalogowany!');

                    return true;
                };

                console.log(isUserLogged);
            }


            function getCode() {
                console.log('jej')            
            }


         
        </script>
    </body>
</html>
