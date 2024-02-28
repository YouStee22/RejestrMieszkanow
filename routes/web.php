<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\Localization;


use App\Models\Miasto;
use App\Models\Rodzina;
use App\Models\Person;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PaymentController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/ 
Route::get('/create-order/{value}/{rediUrl}', [PaymentController::class, 'processPayment']
)->name('getFormMiasto');



Route::prefix('{locale}')
->middleware(Localization::class)
->group(function () {


    Route::get('/hello', function () {
        return view('mainView2');
    })->name('hello');

    Route::get('/goMiasta', function() {
            $allCategories = Miasto::all();

            return view('miasta', ['categories' => $allCategories]);
    })->name('goMiasta');

    Route::get('/goMiastaOdw', function() {
        $allCategories = Miasto::all();

        return view('miasta', ['categories' => $allCategories->reverse()]);
    })->name('goMiastaOdw');

    Route::get('/goMiastaAlf', function() {
        $try = new Miasto();

        $citiesSegregated = $try->getCitiesAlphabetically();

        return view('miasta', ['categories' => $citiesSegregated]);
    })->name('goMiastaAlf');

    Route::post('/searchMiasto', function(Request $req) {
        $data = Miasto::all();

        if (is_numeric($req->data)) {
            $ars = array();
            $atx = Miasto::find($req->data);
            array_push($ars, $atx);

            return view('miasta', ['categories' => $ars]);
        } else {
            $ars = array();
            $atx = str_split($req->data);
            $dbData = Miasto::all();

            foreach ($dbData as $db) {
                $equalities = 0;
                $itx = str_split($db->nazwa);

                for ($x = 0; $x < count($atx); $x++) {
                    if (strtolower($atx[$x]) == strtolower($itx[$x]))
                        $equalities++;
                    else    
                        $equalities = 0;
                }
                if (sizeof($atx) == $equalities) 
                    array_push($ars, $db);
            }
            return view('miasta', ['categories' => $ars]);
        }

        return view('miasta', ['categories' => $data]);
    })->name('searchMiasto');



    Route::get('/getFamilies', function() {

            $rodzina = new Rodzina;
            $atx = $rodzina->getFamiliesObject();

            return view('families', ['families' => $atx]);
    })->name('getFamilies');

    Route::get('/goFamiliesOdw', function() {
        $families = new Rodzina;
        $atx = $families->getFamiliesObject();

        return view('families', ['families' => $atx->reverse()]);
    })->name('goFamiliesOdw');

    Route::get('/goFamiliesAlf', function() {
        $rodzina = new Rodzina;
        $fam = Rodzina::all();
        $families = $rodzina->sortAlphabetically($fam);
       
        return view('families', ['families' => $families]);
    })->name('goFamiliesAlf');

    Route::post('/searchFamily', function(Request $req) {
        
        $rodzina = new Rodzina;
        $families = $rodzina->sortAlphabeticallySurname($req); 
       
        return view('families', ['families' => $families]);
    })->name('searchFamily');



    Route::get('/getOsoby', function() {
        $person = new Person();
        $pers = Person::all();
        $dataPer = $person->processPersonsFromDB($pers);

        return view('osobyPoprawka', ['persons' => $dataPer]);
    })->name('goOsoby');

    Route::get('/getOsobyOdw', function() {
        $psers = Person::all();
        $persons = new Person();
        $dataPer = $persons->processPersonsFromDB($psers);

        return view('osobyPoprawka', ['persons' => array_reverse($dataPer)]);
    })->name('goOsobyOdw');

    Route::get('/getOsobyAfl', function() {
        $class = new Person();
        $persons = $class->sortPersonsAlphabetically();

        return view('osobyPoprawka', ['persons' => $persons]);
    })->name('goOsobyAfl');

    Route::get('/getOsobyAflPoNazwisku', function() {
        $per = new Person();
        $persons = $per->sortBySurnames();

        return view('osobyPoprawka', ['persons' => $persons]);
    })->name('goOsobyPoNazw');

    Route::post('/searchOsoby', function(Request $req) {
        $pwers = new Person();
        $sortedPersons = $pwers->findPerson($req);
        
        return view('osobyPoprawka', ['persons' => $sortedPersons]);
        
    })->name('searchOsoby');



    Route::get('/getFormularz', function() {
        return view('formularz');
    })->name('formularz');

    Route::get('/getFormularzMiasto', function() {
        $crsf = csrf_token();
        return view('registerMiasto',['crsf' => $crsf]);
    })->name('getFormularzMiasto');

    Route::get('/getFormularzRodzina', function() {
        return view('addFamily');
    })->name('getFormularzRodzina');

    Route::get('/logIn', function() {
        return view('login');
    })->name('logIn');



    Route::get('/api/editMiasto/{itx}', [DataController::class, 'editeMiasto'])->name('editMiasto');

    Route::get('/api/editPerson/{itx}', [DataController::class, 'editPerson'])->name('editPerson');

    Route::put('/confEditPerson', [DataController::class, 'confirmEditPerson'])->name('editPerson');

    Route::put('/confEdit', [DataController::class, 'confirmEdit'])->name('confEdit');


    Route::get('/api/addFamilyForm', [DataController::class, 'getMiasta']);



    Route::get('/token', function () {
            return csrf_token(); 
        });

    

    Route::get('/api/getFamilies', [DataController::class, 'getFamilies'])->name('addPerson');

    
    Route::get('/api/miasta', function () {
        $userData = Miasto::all();
        return response()->json($userData);
    });

    Route::get('/api/rodziny', function () {
        $userData = Rodzina::all();
        return response()->json($userData);
    });

    Route::get('/api/osoby', function () {
        $userData = Person::all();
        return response()->json($userData);
    });


    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});



Route::put('/saveMiasto', [DataController::class, 'saveMiasto']);

Route::put('putFamily/{idMiasta}', [DataController::class, 'putFamily']);

Route::put('putPerson/{id}', [DataController::class, 'putPerson']);

