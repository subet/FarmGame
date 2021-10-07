<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config;
use App\Http\Controllers\Feeder;
use App\Http\Controllers\WinControl;
use App\Http\Controllers\Starver;

class Game extends Controller
{
    public function game(Request $request)
    {

        if (session()->missing('game_status'))
        {
            $this->initGame();
        }

        $winControl = new WinControl;
        $feeder = new Feeder;
        $starver = new Starver;

        if ($request->has('do'))
        {
            switch($request->input('do'))
            {
                case "start_game":
                    $this->startGame();
                    break;

                case "feed":
                    $feeder->feed();
                    $starver->starve();
                    break;
            }

            $winControl->check();

            return redirect('/');

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


    public function startGame()
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
                'game_result' => '',
            ]
        );

        return redirect('/');
    }


}
