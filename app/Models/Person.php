<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

use function PHPUnit\Framework\isEmpty;

class Person extends Model
{
    use HasFactory;

   
    protected $table = "persons";

   public function processPersonsFromDB($persons) {
    // $persons = Person::all();
    $array = array();

        foreach ($persons as $person) {
        
            $itx = substr($person->surname, 0, strlen($person->surname) - 2);
            $ptx = substr($person->surname, strlen($person->surname) - 2, strlen($person->surname) - 0);
            if ($person->sex == 'K'  &&  $ptx == 'cy') 
                $person->surname = $itx.'ka';
            if ($person->sex == 'M' &&  $ptx == 'cy') 
                $person->surname = $itx.'ki';
            
            $wta = substr($person->pesel, 0, strlen($person->pesel) - 9);   
            if ($wta < 25) {
                $wta = "20".$wta."\n";
                $person->wiek = date("Y") - $wta."\n";
            } else {
                $wta = "19".$wta."\n";
                $person->wiek = date("Y") - $wta."\n";
            } 
            array_push($array, $person);
        }
        return $array;
   }


   public function sortPersonsAlphabetically() {
        $persons = Person::all();
        $try  = Person::all();

        $array = array();
        foreach ($try as $all) {
            $country = new stdClass();

            $country->id = $all->id;
            $country->name = substr($all->name, 0, 3);
            array_push($array, $country);
        
        }
        usort($array, function($a, $b) {return strcmp(strtoupper($a->name), strtoupper($b->name));});

        $persons = array();

        foreach($array as $it) {
            foreach($try as $itx) {
                if ($it->id == $itx->id) {
                    $city = Person::find($itx->id);
                    array_push($persons, $city);
                }
            }
        }
        json_encode($persons);
        $persons = $this->processPersonsFromDB($persons);

        return $persons;
   }


   public function sortBySurnames() {
    $persons = Person::all();
        $try  = Person::all();

        $array = array();
        foreach ($try as $all) {
            $country = new stdClass();

            $country->id = $all->id;
            $country->surname = substr($all->surname, 0, 3);
            array_push($array, $country);
        
        }
        usort($array, function($a, $b) {return strcmp(strtolower($a->surname), strtolower($b->surname));});

        $persons = array();

        foreach($array as $it) {
            foreach($try as $itx) {
                if ($it->id == $itx->id) {
                    $city = Person::find($itx->id);
                    array_push($persons, $city);
                }
            }
        }
        json_encode($persons);
        $persons = $this->processPersonsFromDB($persons);

        return $persons;
   }

   
   public function findPerson($req) {
        $p = Person::all();
        $persons = $this->processPersonsFromDB($p);
        $sortedPersons = array();

        if (is_numeric($req->data)) {
            foreach ($persons as $a) {
                if ($a->wiek == $req->data)
                    array_push($sortedPersons, $a);
            }
        } else {
            $str = str_split($req->data);

            foreach ($persons as $a) {
                $nazwPodob = 0;
                $surrPodob = 0;
                $firstLett = true;
                $firstLettSurr = true;


                $name = str_split($a->name);
                $surname = str_split($a->surname);
            
                $stx = 0;
                $rtx = 0;
                for ($x = 0; $x < count($str); $x++) {
            
                    if (strtolower($str[0]) != strtolower($name[0])) 
                        $firstLett = false;
                    if (strtolower($str[0]) != strtolower($surname[0]))
                        $firstLettSurr = false;

                    if ($rtx < sizeof($name)) {
                        if (strtolower($str[$x]) == strtolower($name[$rtx])) 
                            $nazwPodob++;
                        else 
                            $nazwPodob = 0;
                        $stx++;
                    }
                    if ($rtx < sizeof($surname)) {
                        if (strtolower($str[$x]) == strtolower($surname[$rtx])) 
                            $surrPodob++;
                        else 
                            $surrPodob = 0;
                        $rtx++;
                    }
                }
                
                if (($nazwPodob > 0  &&  $firstLett)  ||  ($surrPodob > 0  &&  $firstLettSurr)) 
                    array_push($sortedPersons, $a);
            }
        }

        return $sortedPersons;
   }
}
