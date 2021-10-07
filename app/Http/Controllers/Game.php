<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;

class Game extends Controller
{
    public function game(Request $request)
    {

        if ($request->session()->missing('game_status'))
        {
            $this->initGame();
        }

        return view("game");
    }


    public function initGame()
    {
        session(
            [
                'game_status' => 'not_started'
            ]
        );
    }


    public function startGame(Request $request)
    {
        session(
            [
                'game_status' => 'started',
                'farmer_count' => Config::get('constants.FARMER_COUNT'),
                'cow_count' => Config::get('constants.COW_COUNT'),
                'bunny_count' => Config::get('constants.BUNNY_COUNT'),
                'last_feed' => '',
                'total_turns' => 0,
                'max_turns' => Config::get('constants.MAX_TURNS'),
                'farmer_not_fed' => 0,
                'cow_not_fed' => 0,
                'bunny_not_fed' => 0,
                'farmer_starve' => Config::get('constants.FARMER_STARVE'),
                'cow_starve' => Config::get('constants.COW_STARVE'),
                'bunny_starve' => Config::get('constants.BUNNY_STARVE'),
            ]
        );

        return redirect('/');
    }


}
