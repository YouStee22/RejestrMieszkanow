<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="{{ URL('images/city.png') }}" />
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
    <body class="mb-48">
        <main>
            <a href="/hello" class="inline-block text-black ml-4 mb-4"
            ><i class="fa-solid fa-arrow-left"></i> Back</a>
            <div class="mx-4">
                <div
                    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
                >
                    <header class="text-center header-content">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Log In
                        </h2>
                        <p class="mb-4">Zaloguj się do panelu administracyjnego</p>

                        <div class="warnings">
                            <div class="hidden m-4 bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-2 py-3 shadow-md" role="alert" id="alert">
                                <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                <div>
                                    <p id="content" class="font-bold md:ml-3">Zostałeś zalogowany pomyślnie!</p>
                                    <p class="text-sm"></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </header>

                    <form  action="" onsubmit="logIn(); return false">
                        <div class="mb-6">
                            <label for="login" class="inline-block text-lg mb-2"
                                >Login</label
                            >
                            <input
                                type="login"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="login"
                            />
                        </div>

                        <div class="mb-6">
                            <label
                                for="password"
                                class="inline-block text-lg mb-2"
                            >
                                Password
                            </label>
                            <input
                                type="password"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="password"
                            />
                        </div>

                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Zaloguj się
                            </button>
                        </div>

                        <!-- <div class="mt-8">
                            <p>
                                Nie masz konta? 
                                <a href="register.html" class="text-laravel"
                                    >Register</a
                                >
                            </p>
                        </div> -->
                    </form>
                </div>
            </div>
        </main>

        <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-blue-500 text-white h-24 mt-24 opacity-90 md:justify-center"
    >
        <p class="ml-2">Copyright &copy; 2024, All Rights reserved</p>

        <a
            href="create.html"
            class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
            >Miejsce na chat instarama
            </a
        >
    </footer>

    <script>
            function logIn() {


                let form = document.querySelector('form');

                let login = form.querySelector("[name='login']").value;
                let password = form.querySelector("[name='password']").value;
            
                const user = {
                    login: login,
                    password: password
                }

                fetch('api/logIn', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(user)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data != 1) {
                            console.log(data);
                            localStorage.setItem("admin", JSON.stringify(data));
                            document.querySelector('#alert').classList.remove('hidden');
                            localStorage.setItem("Zalogowany", "YES");

                            setTimeout( function() {
                                window.location.href = "/hello";
                            }, 2000)
                        }
                        if (data == 0) {
                            document.querySelector('#alert').classList.remove('hidden');
                            document.querySelector('.warnings').innerHTML = `<div role="alert" class="m-3">
                                                                            <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                                                                                Błąd
                                                                            </div>
                                                                            <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                                                                                <p>Coś poszło nie tak, sprawdz poprawność danych</p>
                                                                            </div>
                                                                            </div>`;

                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                }

    </script>
    </body>
</html>
