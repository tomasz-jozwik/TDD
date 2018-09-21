<?php
declare(strict_types=1);

namespace BallGame\Tests\Domain\Match;

use BallGame\Domain\Match\Match;
use BallGame\Domain\Team\Team;
use BallGame\Domain\Team\TeamsSameNamesException;
use BallGame\Domain\Team\BadTeamNameException;
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
