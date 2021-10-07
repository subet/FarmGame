<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Starver extends Controller
{
    public function starve()
    {
        if (session('last_feed') != 'farmer') 
        {
            session(['farmer_not_fed' => session('farmer_not_fed') + 1]);
        }

        if (session('last_feed') != 'cow') 
        {
            session(['cow_not_fed' => session('cow_not_fed') + 1]);
        }
        
        if (session('last_feed') != 'bunny') 
        {
            session(['bunny_not_fed' => session('bunny_not_fed') + 1]);
        }
    }
}
