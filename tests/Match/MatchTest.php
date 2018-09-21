<?php
declare(strict_types=1);

namespace BallGame\Tests\Match;

use BallGame\Match\Match;
use BallGame\Team\Team;
use BallGame\Team\TeamsSameNamesException;
use BallGame\Team\BadTeamNameException;
use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{
    public function testBothTeamsHaveTheSameName()
    {
        $this->expectException(TeamsSameNamesException::class);

        $teamA = Team::create('Team');
        $teamB = Team::create('Team');
        $match = Match::create($teamA, $teamB, 0, 0);
    }
}
