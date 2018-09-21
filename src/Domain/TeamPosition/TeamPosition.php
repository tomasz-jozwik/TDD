<?php
declare(strict_types=1);

namespace BallGame\Domain\TeamPosition;

use \BallGame\Domain\Team\Team;

class TeamPosition
{
    /**
     * @var Team
     */
    private $team;

    /**
     * @var int
     */
    private $pointsScored = 0;

        /**
     * @var int
     */
    private $pointsAgainst = 0;

    /**
     * @var int
     */
    private $wins;

    public function __construct(Team $team) {
        $this->team = $team;
    }

    public function recordWin() {
        $this->wins++;
    }

    public function getPoints() : int {
        return $this->wins * 3;
    }

    public function getTeam() : Team {
        return $this->team;
    }

    public function recordPointsScored(int $points) {
        $this->pointsScored += $points;
    }

    public function getPointsScored() : int {
        return $this->pointsScored;
    }

    public function recordPointsAgainst(int $points) {
        $this->pointsAgainst += $points;
    }

    public function getPointsAgainst() : int {
        return $this->pointsAgainst;
    }
}
