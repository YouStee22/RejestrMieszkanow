<?php

namespace App\Providers;

use App\Models\Miasto;
use App\Models\Rodzina;
use App\Models\Person;
use App\Models\Singles;
use App\Models\Admins;



class DatabaseSeeder {

    
   
    public static function fillWithCities(): void
    {     
        $namesCities = array("Kraków", "Warszawa", "Kielce", "Łódz", "Gdańsk");
        $namesWoje = array("Małopolskie", "Mazowieckie", "Świętokrzyskie", "Łódzkie", "Pomorskie");
        $namesCodes = array("31100", "23123", "28200", "70445", "808012");
        $namesImg = array("https://www.poczetkrakowski.pl/data/domains/1/m_crm_tomes/4837/files/_5e6f5c55b7006.png", "https://um.warszawa.pl/documents/39703/37320193/Warszawa-znak-400x265.png/70a57a49-57a9-ddf0-17ff-9e0f4ee09759?version=1.0&t=1671617348043&imagePreview=1",
                            "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Herb_miasta_Kielce.svg/1200px-Herb_miasta_Kielce.svg.png", "https://www.znaki24.pl/media/catalog/product/cache/15/image/9df78eab33525d08d6e5fb8d27136e95/u/b/ub051gapn_spot.jpg", 
                            "https://www.siedemgor.pl/userdata/public/gfx/2080/Plakietka-herb-Gdanska-kupienia-w-skaldnicy-harcerskiej-ZHR-SIEDEM-GOR.jpg");
        $namesCountries = array("Polska", "Polska", "Polska", "Polska", "Polska");

        for ($x = 0; $x <= count($namesCities)-1; $x++) {
            $atx = new Miasto();
            $atx->nazwa = $namesCities[$x];
            $atx->wojewodztwo = $namesWoje[$x];
            $atx->kod_pocztowy = $namesCodes[$x];
            $atx->img = $namesImg[$x];
            $atx->kraj = $namesCountries[$x];
            echo $atx;
            $atx->save();

        }
    }



    public static function fillWithFamilies(): void {     
        $nazwisko = array("Michalscy", "Kowalscy", "Ciziel", "Jakubik", "Szlufik", "Piotrkowscy", "Romanowscy");
        $idMiasta = array("1", "2", "2", "2", "3", "3", "2");

        for ($x = 0; $x <= count($nazwisko)-1; $x++) {
            $miasto = Miasto::find($idMiasta[$x]);
            $rodzina = new Rodzina();
            $rodzina->nazwisko = $nazwisko[$x];
            $miasto->rodziny()->save($rodzina);
        }
    }



    public static function fillWithPersons() {

        $idRodzin = array(1, 1, 2, 2, 3, 3, 2, 3, 2, 4, 6, 6);
        $name = array("Błazej", "Aneta", "Tomasz", "Julia", "Ania", "Franek", "Janusz", "Hubert", "Ala", "Krystian", "Jan", "Magda");
        $pesel = array("96281733283", "92281733283", "80281733283", "82281733283", "02281733283", "03281733283", "07281733283", "02281733283", "09281733283", "76281733283", "94281733283", "93281733283");
        $sex = array("M", "K", "M", "K", "K", "M", "M", "M", "K", "M", "M", "K");

        for ($x = 0; $x <= count($idRodzin)-1; $x++) {
            $rodzina = Rodzina::find($idRodzin[$x]);
            $person = new Person();
            $person->name = $name[$x];
            $person->surname = $rodzina->nazwisko;
            $person->pesel = $pesel[$x];
            $person->sex = $sex[$x];
            echo $person;
            $rodzina->savePerson()->save($person);
        }
    }
}
