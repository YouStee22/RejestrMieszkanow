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
                        <p class="mb-4">{{__('formularze.rgrM')}}</p>
                        <div class="alt-div">
                            <p class="hidden text-red-500 text-md mt-1" id="warning">
                                {{__('formularze.error')}}
                            </p>
                        </div>
                    </header>

                    <form action="" onsubmit="takeForumlarz(); return false">
                        <input id="crsf" hidden value="{{ $crsf }}">
                        <div class="mb-6">
                            <label for="nazwa" class="inline-block text-lg mb-2">
                                {{__('formularze.nm')}}
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="nazwa"
                            />
                        </div>

                        <div class="mb-6">
                            <label for="wojewodztwo" class="inline-block text-lg mb-2"
                                >  {{__('formularze.st')}}</label
                            >
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="wojewodztwo"
                            />
                        </div>

                        <div class="mb-6">
                            <label
                                for="kod_pocztowy"
                                class="inline-block text-lg mb-2"
                            >
                            {{__('formularze.pst')}}
                            </label>
                            <input
                                type="number"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="kod_pocztowy"
                            />
                            <p class="text-red-500 text-xs mt-1">
                                {{__('formularze.pstN')}}
                            </p>
                        </div>

                        <div class="mb-6">
                            <label
                                for="img"
                                class="inline-block text-lg mb-2"
                            >
                            {{__('formularze.ctl')}}
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="img"
                            />
                        </div>

                        <div class="mb-6">
                            <label
                                for="kraj"
                                class="inline-block text-lg mb-2"
                            >
                            {{__('formularze.country')}}

                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="kraj"
                            />
                        </div>

                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-black">
                                {{__('formularze.adC')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        
        </main>





       <script>
         let crsf = document.querySelector('#crsf').value;
         console.log(crsf);


            function takeForumlarz() {
                
                let isCountryPoland;
                let isPostCodeProper;
                let form = document.querySelector('form');

                let nazwa = form.querySelector("[name='nazwa']").value;
                let wojewodztwo = form.querySelector("[name='wojewodztwo']").value;
                let kod_pocztowy = form.querySelector("[name='kod_pocztowy']").value;
                let img = form.querySelector("[name='img']").value;
                let kraj = form.querySelector("[name='kraj']").value;

                if (kraj === "Polska") {
                    isCountryPoland = checkState(wojewodztwo);
                    isPostCodeProper = kod_pocztowy.length === 5;
                }

                if ((nazwa && wojewodztwo && kod_pocztowy && kraj !== "")  &&  isCountryPoland 
                        &&  isPostCodeProper) {
                    sendToDataBase(nazwa, wojewodztwo, kod_pocztowy, img, kraj);
                } else {
                    console.log('Błąd');
                    document.getElementById('warning').classList.remove('hidden');
                }

            }

            function checkState(wojewodztwo) {
                const wojewodztwa = ["dolnośląskie", "kujawsko-pomorskie", "lubelskie", "lubuskie", "łódzkie",
                                "małopolskie", "mazowieckie", "opolskie", "podkarpackie", "podlaskie",
                                "pomorskie", "śląskie", "świętokrzyskie", "warmińsko-mazurskie", 
                                "wielkopolskie", "zachodniopomorskie"];

                
                for (let i = 0; i < wojewodztwa.length; i++) {
                     if (wojewodztwa[i] === wojewodztwo.toLowerCase()) 
                        return true;
                }
                return false;
                
            }
       
            function sendToDataBase(nazwa, wojewodztwo, kod_pocztowy, img, kraj) {
                if (img === "")
                    img = "Brak";

                let country = {
                    nazwa : nazwa,
                    wojewodztwo : wojewodztwo,
                    kod_pocztowy : kod_pocztowy,
                    img : img,
                    kraj : kraj
                };

        

                fetch('http://127.0.0.1:8000/saveMiasto', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN' : crsf
                    },
                    body: JSON.stringify(country)
                    })
                    .then(data => {
                        document.querySelector('.alt-div').innerHTML = `  <div class="bg-teal-100 my-3 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                                                                    <div class="flex">
                                                                    <div class="py-2"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                                                        <div>
                                                                            <p class="font-bold">{{__('formularze.mAdded')}}</p>
                                                                            <p class="text-sm">Miasto '${nazwa}' {{__('formularze.rgSuc')}}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>`;
                        setTimeout(function() {
                            window.location.href = "{{ url(app()->getLocale() == 'pl'? 'pl/getFormularz' : 'en/getFormularz')}}";
                        },3000);                                   
                    });
                    
                
            }
       </script>
    </body>
</html>
