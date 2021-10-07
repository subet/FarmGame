<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\WinControl;

class Feeder extends Controller
{
    public function feed(Request $request)
    {
        if (!$this->canBeFed())
            return;

        // Feed
        $farm_residents = ["farmer", "cow", "bunny"];
        $feeding_resident = $farm_residents[rand(0, 2)];

        Session(
            [
                'last_feed' => $feeding_resident,
                'total_turns' => $request->session('total_turns') + 1,
                $feeding_resident.'_not_fed' => 0,
            ]
        );


        return redirect('/');
    }

    public function canBeFed()
    {
        // If game not started, don't feed
        // TODO: Write an error handler here
        if ($request->session()->missing('game_status') || $request->session('game_status')!='started')
            return false;

        // If we reach to maximum number of turns, don't feed
        // TODO: Write an error handler here
        $total_turns = $request->session('total_turns');
        $max_turns = $request->session('max_turns');

        if ($total_turns >= $max_turns) 
            return false;

        return true;
    }
}
