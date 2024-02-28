<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;


class Miasto extends Model
{
    use HasFactory;


    protected $table = "miastos";

    public function rodziny() {
        return $this->hasMany(Rodzina::class);
    }

    public function getCitiesAlphabetically() {
        $try = Miasto::all();
        $array = [];

        foreach ($try as $all) {
            $country = new stdClass();

            $country->id = $all->id;
            $country->nazwa = substr($all->nazwa, 0, 1);
            array_push($array, $country);
        }
        usort($array, function($a, $b) {return strcmp(strtolower($a->nazwa), strtolower($b->nazwa));});

        $citiesSegregated = array();

        foreach($array as $it) {
            foreach($try as $itx) {
                if ($it->id == $itx->id) {
                    $city = Miasto::find($itx->id);
                    array_push($citiesSegregated, $city);
                }
            }
        }
        json_encode($citiesSegregated);

        return $citiesSegregated;
    }
}
