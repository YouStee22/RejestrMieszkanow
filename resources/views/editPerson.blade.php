<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
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
        <title>LaraGigs | Find Laravel Jobs & Projects</title>
    </head>
    

        <main>
            <a href="{{ url(app()->getLocale() == 'pl'? 'pl/getOsoby' : 'en/getOsoby')}}" class="inline-block text-black ml-4 mb-4"
            ><i class="fa-solid fa-arrow-left"></i> {{__('welcome.bck')}}</a>
  
        
            <div class="mx-4">
                <div
                    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
                >
                    <header class="text-center mb-12">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            {{__('formularze.frm')}}
                        </h2>
                     
                        <div class="alt-div">
                            <p class="hidden text-red-500 text-md mt-1" id="warning">
                                {{__('formularze.error')}}
                            </p>
                        </div>
                    </header>

                    <form action="{{route('editPerson')}}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="mb-6">
                            <label for="name" class="inline-block text-lg mb-2">
                                {{__('welcome.nma')}}
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="name" value="{{$data['name']}}"
                            />
                        </div>

                        <div class="mb-6">
                            <label for="wojewodztwo" class="inline-block text-lg mb-2"
                                >Pesel</label 
                            >
                            <input
                                type="number"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="pesel"  value="{{$data['pesel']}}"
                            />  <p class="text-red-500 text-xs mt-1">
                                {{__('formularze.pstN')}}
                            </p>
                        </div>

                        <div class="mb-6">
                            <label
                                for="kod_pocztowy"
                                class="inline-block text-lg mb-2"
                            >
                            {{__('welcome.sex')}} M/K
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="sex"  value="{{$data['sex']}}"
                            />
                          
                        </div>

                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-black">
                                {{__('formularze.mdf')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        
        </main>
    </body>
</html>