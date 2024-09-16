<?php

namespace App\Classes;

use App\Constants\GameConstants;

class RockPaperScissorsRules
{
    /**
     * Rules
     *
     * @param  mixed $player_1_pick
     * @param  mixed $player_2_pick
     * @return void
     */
    public static function run($player_1_pick, $player_2_pick)
    {
        if ($player_1_pick == GameConstants::ROCK && $player_2_pick == GameConstants::SCISSORS) {
            $result = GameConstants::PLAYER_1;
        } elseif ($player_2_pick == GameConstants::PAPER && $player_1_pick == GameConstants::ROCK) {
            $result = GameConstants::PLAYER_2;
        } elseif ($player_1_pick == GameConstants::ROCK && $player_2_pick == GameConstants::ROCK) {
            $result = GameConstants::DRAW;
        }

        return $result;
    }
}
