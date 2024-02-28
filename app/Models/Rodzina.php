<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;


class Rodzina extends Model
{
    use HasFactory;


    protected $table = "families";



    public function savePerson() {
        return $this->hasMany(Person::class);
    }

    public function getFamiliesObject() {
        $families = Rodzina::all();
        
        foreach ($families as $value) {
        
            $miastoId = Miasto::find($value->miasto_id)->nazwa;

            $kraj = Miasto::find($value->miasto_id)->kraj;
            $persTab = Person::all();
            $quantityOfFamily = 0;

            foreach($persTab as $quant) {
                if ($quant->rodzina_id == $value->id) 
                    $quantityOfFamily++;
            }
            
            $value->quantityFamily = $quantityOfFamily;    
            $value->miasto = $miastoId;
            $value->kraj = $kraj;
        }
        return $families;
    }

    public function person() {
        return $this->belongsTo(Miasto::class);
    }

    public function sortAlphabetically() {

        $try  = $this->getFamiliesObject();

        $array = array();
    
        foreach ($try as $all) {
            $country = new stdClass();

            $country->id = $all->id;
            $country->nazwisko = substr($all->nazwisko, 0, 1);
            $country->quantityFamily = $all->quantityFamily;    
            $country->miasto = $all->miasto;
            $country->kraj = $all->kraj;
            array_push($array, $country);
        }
        usort($array, function($a, $b) {return strcmp(strtolower($a->nazwisko), strtolower($b->nazwisko));});

        $families = array();
        foreach($array as $it) {
        
            foreach($try as $itx) {
                
                if ($it->id == $itx->id) {
                    $city = Rodzina::find($itx->id);
                    $city->quantityFamily = $itx->quantityFamily;    
                    $city->miasto = $itx->miasto;
                    $city->kraj = $itx->kraj;
        
                    array_push($families, $city);
                }
            }
        }
        json_encode($families);

        return $families;
    }

    public function sortAlphabeticallySurname($req) {
        $atx = $this->getFamiliesObject();
        $families = array();

        if (is_numeric($req->data)) {
            foreach ($atx as $a) {
                if ($a->quantityFamily == $req->data)
                    array_push($families, $a);
            }
        } else {
            $str = str_split($req->data);

            foreach ($atx as $a) {
                $nazwPodob = 0;
                $firstLett = true;

                $it = str_split($a->nazwisko);

                $stx = 0;
                for ($x = 0; $x < count($str); $x++) {
                    if (strtolower($str[0]) != strtolower($it[0])) 
                        $firstLett = false;

                    if ($stx < sizeof($it)) {
                        if (strtolower($str[$x]) == strtolower($it[$stx])) 
                            $nazwPodob++;
                        else 
                            $nazwPodob = 0;
                        $stx++;
                    }
                }
                if ($nazwPodob > 0  &&  $firstLett) 
                    array_push($families, $a);
            }
        }

        return $families;
    }


}
