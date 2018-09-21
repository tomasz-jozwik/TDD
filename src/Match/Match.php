<?php
declare(strict_types=1);

namespace BallGame\Match;

use BallGame\Team\Team;

class Match
{
    /**
     * @var Team
     */
    private $teamOne;

    /**
     * @var Team
     */
    private $teamTwo;

    /**
     * @var int
     */
    private $teamOneScore;

    /**
     * @var int
     */
    private $teamTwoScore;

    public function getTeamOne() : Team {
        return $this->teamOne;
    }

    public function getTeamTwo() : Team {
        return $this->teamTwo;
    }

    public function getTeamOneScore() : int {
        return $this->teamOneScore;
    }

    public function getTeamTwoScore() : int {
        return $this->teamTwoScore;
    }

    private function __construct(Team $teamOne, Team $teamTwo, int $teamOneScore, int $teamTwoScore) {
        $this->teamOne = $teamOne;
        $this->teamTwo = $teamTwo;
        $this->teamOneScore = $teamOneScore;
        $this->teamTwoScore = $teamTwoScore;
    }

    public function create(Team $teamOne, Team $teamTwo, int $teamOneScore, int $teamTwoScore) {
        return new self($teamOne, $teamTwo, $teamOneScore, $teamTwoScore);
    }
}
