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
            <a href="{{ url(app()->getLocale() == 'pl'? 'pl/getFormularz' : 'en/getFormularz')}}" class="inline-block text-black ml-4 mb-4"
            ><i class="fa-solid fa-arrow-left"></i> Back</a>
  
        
            <div class="mx-4">
                <div
                    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
                >
                    <header class="text-center mb-5">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            {{__('formularze.frm')}}
                        </h2>
                        <p class="mb-4"> {{__('formularze.rgfm')}}</p><br>
                        <p class="mb-4">{{__('formularze.ver')}}</p>
                        <div class="alt-div">
                            <p class="hidden text-red-500 text-md mt-1" id="warning">
                                {{__('formularze.error')}}
                            </p>
                        </div>
                    </header>

                    
                        <div class="mb-6" id="main">
                            <label for="email" class="inline-block text-lg mb-2">
                                {{__('formularze.em')}}
                            </label>
                            <input
                                type="email"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="email"
                            />
                        </div> 

                        <div class="mb-6">
                            <button id="sendButt"
                                type="submit"
                                class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-blue-700" onclick="getEmail()">
                                {{__('formularze.sdC')}}                            
                            </button>
                        </div>
                  
                </div>
            </div>
    
        
        </main>




        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
        <script type="text/javascript">
            (function() {
                emailjs.init('42wwBWQLVmQYVSUTl');
            })();
        </script>
       <script>

        function getEmail() {
            let email = document.getElementsByName("email");
            console.log(email[0].value);
            let code = generateCode();

            let dataWaznosci = getOrCheckTime(true);
            console.log(dataWaznosci);

            var templateParams = {
                            type: 'rodziny',
                            from: 'RM | Rejestr Mieszkańców',
                            code: code,
                            email: email[0].value,
                            czas: dataWaznosci,
                        };

            var codeBase = {
                        code : code,
                        time : getOrCheckTime(false),
                    }
            console.log(templateParams);

            console.log(codeBase);

                emailjs.send('service_tx63j9b', 'template_iznm89r', templateParams)
                    .then(function(response) {
                        console.log('SUCCESS!', response.status, response.text);
                        localStorage.setItem('kodAktywacyjny', JSON.stringify(codeBase));
                        goNext();
                    }, function(error) {
                        console.log('FAILED...', error);
                    });
                        localStorage.setItem('kodAktywacyjny', JSON.stringify(codeBase));
                        goNext();
        }

        function generateCode() {
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

                let result = '';
                for (let i = 0; i < 7; i++) {
                    result += characters.charAt(Math.floor(Math.random() * characters.length));
                }

                return result; 
        }

        function goNext() {
            let doc = `<label for="nazwa" class="inline-block text-lg mb-2">
                                Podaj kod z wiadomości
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="text"/>`;

            document.querySelector('#main').innerHTML = doc;                
            document.querySelector('#sendButt').innerText = 'Akceptuje';      
            document.getElementById('sendButt').setAttribute( "onClick", "veryficateCode()");
        }

        function veryficateCode() {
            let code = localStorage.getItem('kodAktywacyjny');
            let jsonTime = JSON.parse(code);

            let email = document.getElementsByName("text");

        
            if (Date.parse(jsonTime.time) > new Date().getTime()  &&  (email[0].value === jsonTime.code)) 
                window.location.href = "api/addFamilyForm";
            else 
                document.querySelector('#warning').classList.remove('hidden');
        }


        function getOrCheckTime(whatToCheck) {
            const currentDate = new Date();
            const timestamp = currentDate.getTime();    
          
            var hours = currentDate.getHours();
            var minutes = currentDate.getMinutes();

            currentDate.setMinutes(currentDate.getMinutes() + 5);

            let dataWaznosci =currentDate.getHours() + ":" + currentDate.getMinutes();
            if (whatToCheck) 
                return dataWaznosci;
            else 
                return currentDate;
        }
       </script>
    </body>
</html>
