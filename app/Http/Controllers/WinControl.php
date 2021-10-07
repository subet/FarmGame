<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WinControl extends Controller
{
    public function check()
    {
        
        // Checking farmer
        if (session('farmer_not_fed') >= session('farmer_starve'))
        {
            $this->fail();
            return;
        }

        // Checking cows
        if (session('cow_not_fed') >= session('cow_starve'))
        {
            session(['cow_count' => session('cow_count') - 1]);
            session(['cow_not_fed' => 0]);

            if (session('cow_count') == 0)
            {
                $this->fail();
                return;
            }
        }

        // Checking bunnies
        if (session('bunny_not_fed') >= session('bunny_starve'))
        {
            session(['bunny_count' => session('bunny_count') - 1]);
            session(['bunny_not_fed' => 0]);

            if (session('bunny_count') == 0)
            {
                $this->fail();
                return;
            }
        }

        // Checking if game finished
        if (session('total_turns') >= session('max_turns'))
        {
            $this->success();
        }

    }

    public function fail()
    {
        session(['game_status' => 'not_started']);
        session(['game_result' => 'fail']);
    }

    public function success()
    {
        session(['game_status' => 'not_started']);
        session(['game_result' => 'success']);
    }

}
