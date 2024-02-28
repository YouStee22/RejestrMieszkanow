<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function miasta1() {

        $categories = ['Category1', 'Categories2'];

        /*lub $allCategories = Miasto::all();*/ 
        $allCategories = DB::table('miastos')->get();
        echo $allCategories;

        return ['categories' => $allCategories];
    }


}
