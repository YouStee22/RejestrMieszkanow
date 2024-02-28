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
        <title>RM | Find People City & Families</title>
    </head>
    

        <main>
            <a href="{{ url(app()->getLocale() == 'pl'? 'pl/getFormularz' : 'en/getFormularz')}}" class="inline-block text-black ml-4 mb-4"
            ><i class="fa-solid fa-arrow-left"></i> {{__('welcome.bck')}}</a>
  
        
            <div class="mx-4">
                <div
                    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
                >
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            {{__('formularze.frm')}}
                        </h2>
                        <p class="mb-4">{{__('formularze.rsO')}}</p>
                        <div class="alt-div">
                            <p class="hidden text-red-500 text-md mt-1" id="warning">
                                Któraś z wprowadzonych danych zawiera błąd
                            </p>
                        </div>
                    </header>

                    <form action="" onsubmit="; return false">

                     
                        <div class="mb-6">
                            <label for="nazwa" class="inline-block text-lg mb-2">
                                {{__('welcome.nma')}}
                            </label>
                            <input
                                type="text"
                                class="data border border-gray-200 rounded p-2 w-full"
                                name="name"
                            />
                        </div>
                        <div class="mb-6">
                            <label for="wojewodztwo" class="inline-block text-lg mb-2"
                                >Pesel</label
                            >
                            <input
                                type="number"
                                class="data border border-gray-200 rounded p-2 w-full"
                                name="pesel"
                            />
                        </div>

                        <div class="mb-6">
                            <label for="wojewodztwo" class="inline-block text-lg mb-2"
                                >{{__('welcome.sex')}} M/K</label
                            >
                            <input
                                type="text"
                                class="data border border-gray-200 rounded p-2 w-full"
                                name="sex"
                            />
                        </div>

                        <input hidden id="crsf" value="{{ $crsf }}">

                        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4 mt-4">
                            @foreach($rodziny as $rodzina)
                                
                                <div class="flex bg-gray-200 p-2 justify-between">
                                    <div class="flex">
                                        <div class="w-9">
                                            <img class="h-9" src="{{URL::asset('/images/Family.png')}}">
                                        </div>
                                        <div class="ml-3 mt-1"><b>{{$rodzina->nazwisko}}</b></div>
                                    </div>
                                    <input id="{{ $rodzina->id }}" onclick="setZero(this.id)" type="checkbox" value="{{ $rodzina->id }}" class="inboxes w-7 h-5 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">

                                </div>
                            @endforeach 
                        </div>

                        <div class="mt-6">
                            <button
                                type="submit" onclick="check()"
                                class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-black">
                                {{__('formularze.addP')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        
        </main>

       <script>
            let crsf = document.querySelector('#crsf').value;
            let idRodziny;
            
            function setZero(value) {
                let inputArrays = document.querySelectorAll('.inboxes');

                idRodziny = value;
                for (let i = 0; i < inputArrays.length; i++) {
                    if (inputArrays[i].value != value)  
                        inputArrays[i].checked = false;
                }
            }


            function check() {
                let data = document.querySelectorAll('.data');
                
                data.forEach(element => {
                    if (element.id === "") {
                        document.getElementById('warning').classList.remove('hidden');
                        document.getElementById('warning').innerText = '{{__('formularze.smtM')}}';
                }
                });
                
                let isAnyCheckboxClicked;
                let inputArrays = document.querySelectorAll('.inboxes');
                inputArrays.forEach(element => {
                    console.log(element);
                    if (element.checked)
                        isAnyCheckboxClicked = true;
                    else {
                        document.getElementById('warning').classList.remove('hidden');
                        document.getElementById('warning').innerText = '{{__('formularze.wrr')}}';
                    }
                });

            if (isAnyCheckboxClicked) {
                    console.log(idRodziny);
                    console.log(crsf)
                
                let obj = {
                    "name" : data[0].value,
                    "surname": "Brak",
                    "pesel" : data[1].value,
                    "sex" : data[2].value
                }

                console.log(obj);

                let obj1 = JSON.stringify(obj);

            
            fetch(`http://127.0.0.1:8000/putPerson/${idRodziny}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN' : crsf
                    },
                    body: obj1
                })
                .then(data => {
                    console.log(data);
                    if (data.status == 200) {
                        console.log("YAY!");
                       
                        document.getElementById('warning').classList.remove('hidden');
                        document.getElementById('warning').innerText = '{{__('formularze.padded')}}';
                        document.getElementById('warning').classList.add('text-green-500');
                        setTimeout(() => {
                            window.location.href = "{{ url(app()->getLocale() == 'pl'? 'pl/getFormularz' : 'en/getFormularz')}}";
                        }, 2000);
                    }
                })
                    
            } else {
                document.getElementById('warning').innerText = ' {{__('formularze.wheF')}}'
                document.getElementById('warning').classList.remove('hidden');
        }
    }

        
       </script>
    </body>
</html>
