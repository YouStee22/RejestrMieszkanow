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
          

        <main>
            <div class="mx-4">
                <div
                    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
                >
                    <header class="text-center mb-4">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            {{__('formularze.frm')}}
                        </h2>
                        <p class="mb-4">{{__('formularze.fmr')}}</p>
                        <div class="alt-div">
                            <p class="hidden text-red-500 text-md mt-1" id="warning">
                                {{__('formularze.pfs')}}
                            </p>
                        </div>
                    </header>

                    <form action="" onsubmit="return false" >
                        <input id="crsf" hidden value="{{ $crsf }}">
                    {{-- <form  action="/putFamily/" method="POST">
                        @csrf
                        {{ method_field('PUT') }} --}}

                        <div class="mb-6">
                            <label for="nazwisko" class="inline-block text-lg mb-2">
                                {{__('formularze.sf')}}
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="nazwisko" pattern=".{3,}" required title="3 characters minimum"/>
                            </div>

                        <p class="inline-block text-lg mb-2"> {{__('formularze.cit')}}</p>
                        <div class="lg:grid lg:grid-cols-3 gap-4 space-y-4 md:space-y-0 mx-4 mt-4">
                            
                        @foreach($miasta as $miasto)
                            
                            <div class="flex bg-gray-200 p-2 justify-between">
                                <div>
                                    <div class="w-9">
                                        <img class="h-9"  src="{{$miasto->img}}">
                                    </div>
                                    <div class="mt-1"><b>{{$miasto->nazwa}}</b></div>
                                </div>
                                <input id="remember" onclick="setZero(this.value)" type="checkbox" value="{{ $miasto->id }}" class="inboxes w-7 h-5 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">

                            </div>
                        

                        @endforeach
                    </div>


                        <div class="mb-6 mt-8">
                            <button onclick="check()"
                                type="submit"
                                class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-black">
                                {{__('formularze.addF')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        
        </main>





       <script>
        var idMiasta;
        let crsf = document.querySelector('#crsf').value;
        
        function setZero(value) {
            let inputArrays = document.querySelectorAll('.inboxes');

            idMiasta = value;
            for (let i = 0; i < inputArrays.length; i++) {
                if (inputArrays[i].value != value)  
                    inputArrays[i].checked = false
            }
       }

       function check() {
        let canPass = true;;
        let nazwisko = document.getElementsByName('nazwisko')[0].value;
        if (nazwisko.length < 3) {
            document.getElementById('warning').classList.remove('hidden');
            document.getElementById('warning').innerText = ' {{__('formularze.sErr')}}';
            canPass = false;
        }
        if (nazwisko === "") {
            document.getElementById('warning').classList.remove('hidden');
            document.getElementById('warning').innerText = '{{__('formularze.whtF')}}';
            canPass = false;
        }
        let isAnyCheckboxClicked;
        let inputArrays = document.querySelectorAll('.inboxes');
        inputArrays.forEach(element => {
            if (element.checked)
                isAnyCheckboxClicked = true;
        });

        if (isAnyCheckboxClicked  &&  canPass) {
            console.log(idMiasta);
            console.log(crsf)
            let obj = {
                "nazwisko" : nazwisko,
            }

            let obj1 = JSON.stringify(obj);
            console.log(obj);
            fetch(`http://127.0.0.1:8000/putFamily/${idMiasta}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN' : crsf
                    },
                    body: obj1
                })
                .then(data => {
                    if (data.status == 200) {
                        console.log("YAY!");
                       
                        document.getElementById('warning').classList.remove('hidden');
                        document.getElementById('warning').innerText = '{{__('formularze.fAdd')}}';
                        document.getElementById('warning').classList.add('text-green-500');
                        setTimeout(() => {
                            window.location.href = "{{ url(app()->getLocale() == 'pl'? 'pl/getFormularz' : 'en/getFormularz')}}";
                        }, 2000);
                    }
                })
                    
        } else {
            document.getElementById('warning').innerText = '{{__('formularze.whereU')}}'
            document.getElementById('warning').classList.remove('hidden');
        }

        
       }
       </script>
    </body>
</html>
