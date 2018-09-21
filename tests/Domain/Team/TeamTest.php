<?php
declare(strict_types=1);

namespace BallGame\Tests\Domain\Team;

use BallGame\Domain\Match\Match;
use BallGame\Domain\Team\Team;
use BallGame\Domain\Team\TeamsSameNamesException;
use BallGame\Domain\Team\BadTeamNameException;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    public function testNameIsNotEmpty()
    {
        $this->expectException(BadTeamNameException::class);

        $team = Team::create('');
    }
}
