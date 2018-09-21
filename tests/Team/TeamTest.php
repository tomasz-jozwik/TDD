<?php
declare(strict_types=1);

namespace BallGame\Tests\Team;

use BallGame\Match\Match;
use BallGame\Team\Team;
use BallGame\Team\TeamsSameNamesException;
use BallGame\Team\BadTeamNameException;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    public function testNameIsNotEmpty()
    {
        $this->expectException(BadTeamNameException::class);

        $team = Team::create('');
    }
}
