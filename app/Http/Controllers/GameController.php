<?php

namespace App\Http\Controllers;

use App\Classes\RockPaperScissorsRules;
use App\Constants\GameConstants;
use App\Http\Resources\GameResource;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $total_no_of_rounds = 100;
    protected $player_1_pick;
    protected $options = [GameConstants::ROCK, GameConstants::PAPER, GameConstants::SCISSORS];
    protected $no_of_rounds_player_1_win = 0;
    protected $no_of_rounds_player_2_win = 0;
    protected $no_of_rounds_draw = 0;

    /**
     * Rock, paper and scissors game play
     *
     * @return void
     */
    public function play()
    {
        for ($round = 1; $round <= $this->total_no_of_rounds; $round++) {
            $this->player_1_pick = GameConstants::ROCK;
            $player_2_pick = $this->getRandomChoice();

            $winner = RockPaperScissorsRules::run($this->player_1_pick, $player_2_pick);

            switch ($winner) {
                case GameConstants::PLAYER_1:
                    $this->no_of_rounds_player_1_win++;
                    break;

                case GameConstants::PLAYER_2:
                    $this->no_of_rounds_player_2_win++;
                    break;

                case GameConstants::DRAW:
                    $this->no_of_rounds_draw++;
                    break;
            }
        }

        $result = [
            'no_of_rounds_player_1_win' => $this->no_of_rounds_player_1_win,
            'no_of_rounds_player_2_win' => $this->no_of_rounds_player_2_win,
            'no_of_rounds_draw' => $this->no_of_rounds_draw
        ];

        return new GameResource($result);
    }

    /**
     * Get Random Choice
     *
     * @return void
     */
    private function getRandomChoice()
    {
        $randomKey = array_rand($this->options);
        return $this->options[$randomKey];
    }
}
