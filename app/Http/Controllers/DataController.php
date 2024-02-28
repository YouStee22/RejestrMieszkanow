<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Miasto;
use App\Models\Rodzina;
use App\Models\Person;
use App\Models\Admin;

use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    
    function show() {
        $data = Miasto::all();
        return view('list-veiew', ['miasta'=>$data]);
    }

    public function saveMiasto(Request $reqMiasto) {
        $miasto = new Miasto();
        $miasto->nazwa = $reqMiasto->nazwa;
        $miasto->wojewodztwo = $reqMiasto->wojewodztwo;
        $miasto->kod_pocztowy = $reqMiasto->kod_pocztowy;
        $miasto->img = $reqMiasto->img;
        $miasto->kraj = $reqMiasto->kraj; 
        echo $miasto;


        if ($miasto->save()) {
            return ["result" => "Miasto dodane"];
        } else {
            echo $miasto;
            return ["result" => "Błąd w dodawaniu Miasta"];
        }
    }

    public function saveFamily(Request $reqFamily, $id) {
        $miasto = Miasto::find($id);
        $rodzina = new Rodzina();
        $rodzina->nazwisko = $reqFamily->nazwisko;

        if ($miasto->rodziny()->save($rodzina)) {
            return ["result" => "Rodzina dodana"];
        } else {
            return ["result" => "Błąd w dodawaniu rodziny"];
        }
    }

    public function savePerson(Request $reqPerson, $id) {
        $family = Rodzina::find($id);
        echo $family;
        $person = new Person();
        $person->name = $reqPerson->name;
        $person->surname = $family->nazwisko;
        $person->pesel = $reqPerson->pesel;
        $person->sex = $reqPerson->sex;

        if ($family->savePerson()->save($person)) {
            return ["result" => "Osoba dodana"];
        } else {
            return ["result" => "Błąd w dodawaniu Osoba"];
        }
    }


    public function logIn(Request $reqLog) {
        $admins = Admin::all();

        foreach ($admins as $adm) {
            if ($adm->login == $reqLog->login  &&  $adm->password ==  $reqLog->password) 
                return $adm;
        }

        return 0;
    }


    public function deleteMiasto($id) {
        
        if (Miasto::find($id)->delete()) 
            // return  to_route('/goMiasta');
        return redirect(app()->getLocale().'/goMiasta');
        else 
            return "Błąd, spróbuj ponownie";
    } 

    public function deleteFamily($id) {
        
        if (Rodzina::find($id)->delete()) 
            return redirect(app()->getLocale().'/getFamilies');
        else 
            return "Błąd, spróbuj ponownie";
    } 

    public function deletePerson($id) {
        
        if (Person::find($id)->delete()) 
            return redirect(app()->getLocale().'/getOsoby');
        else 
            return "Błąd, spróbuj ponownie";
    } 




    public function editeMiasto($id, $itx) {
        // echo $itx." id";
        $data = Miasto::find($itx);

        return view('editMiasto', ['data' => $data]);
    }

    public function editPerson($id, $itx) {
        $data = Person::find($itx);
        return view('editPerson', ['data' => $data]);
    }

    public function confirmEditPerson(Request $req) {
        $per = Person::find($req->id);
        $per->name = $req->name;
        $per->pesel = $req->pesel;
        $per->sex = $req->sex;
   
        if ($per->save()) 
            return redirect(app()->getLocale().'/hello');
        else 
            return "Błąd";
        
    }

    public function confirmEdit(Request $req) {
        $per = Miasto::find($req->id);
        $per->nazwa = $req->nazwa;
        $per->wojewodztwo = $req->wojewodztwo;
        $per->kod_pocztowy = $req->kod_pocztowy;
        $per->img = $req->img;
        if ($req->img == "") 
            $per->img = "Brak";
        $per->kraj = $req->kraj;

        if ($per->save()) 
            return redirect(app()->getLocale().'/hello');
        else
            return "Błąd";
        
    }

    public function getMiasta() {
        $miasta = Miasto::all();
        $crsf = csrf_token();

        return view('addFamilyForm', ['miasta' => $miasta], ['crsf' => $crsf]);
    }
 
    public function putFamily(Request $req, $idMiasta) {

        $miasto = Miasto::find($idMiasta);
        $family = new Rodzina();
        $family->nazwisko = $req->nazwisko;

        echo $req->nazwisko;
        echo $idMiasta;

        if ($miasto->rodziny()->save($family)) 
            return "Sukces";
        else 
            return "Bład";
    }
    
    public function getFamilies() {
        $rodziny = Rodzina::all();
        $crsf = csrf_token();

        return view('addPerson', ['rodziny' => $rodziny], ['crsf' => $crsf]);
    }

    public function putPerson(Request $req, $idRodziny) {

        $rodzina = Rodzina::find($idRodziny);

        $person = new Person();
        $person->name = $req->name;
        $person->surname = Rodzina::find($idRodziny)->nazwisko;
        $person->pesel = $req->pesel;
        $person->sex = $req->sex;
        
        if ($rodzina->savePerson()->save($person)) 
            return "udalo";
        else 
            return "Błąd";
    }

    public function getRodzinaByMiasto($id) {
        $rodziny = Miasto::find($id)->rodziny;
        return $rodziny;
    }

    public function getMiastoById($id) {
        $miasto = Miasto::find($id);
        return $miasto;
    }




  
}
