<?php
declare(strict_types=1);

namespace BallGame\Tests\Domain;

use BallGame\Domain\Standings\Standings;
use BallGame\Domain\Match\Match;
use BallGame\Domain\Team\Team;
use BallGame\Domain\TeamPosition\TeamPosition;
use BallGame\Domain\RuleBook\SimpleRuleBook;
use PHPUnit\Framework\TestCase;

class StandingsWithSimpleRuleBookTest extends TestCase
{
    /**
     * @var RuleBookInterface
     */
    protected $ruleBook;

    /**
     * @var Standings
     */
    protected $standings;

    public function setUp() {
        $this->ruleBook = new SimpleRuleBook();
        $this->standings = new Standings($this->ruleBook);
    }

    public function testGetStandingsReturnsSortedLeagueStandings() {
        // Given
        $tigers = Team::create('Tigers');
        $elephants = Team::create('Elephants');
        $match = Match::create($tigers, $elephants, 2, 1);

        $this->standings->record($match);

        // When
        $actualStandings = $this->standings->getSortedStandings();

        // Then
        $this->assertSame(
            [
                ['Tigers', 2, 1, 3],
                ['Elephants', 1, 2, 0]
            ],
            $actualStandings
        );
    }

    public function testGetStandingsReturnsSortedLeagueStandingsWhenSecondTeamEndsUpInFirstPlace() {
        // Given
        $tigers = Team::create('Tigers');
        $elephants = Team::create('Elephants');
        $match = Match::create($tigers, $elephants, 0, 1);

        $this->standings->record($match);

        // When
        $actualStandings = $this->standings->getSortedStandings();

        // Then
        $this->assertSame(
            [
                ['Elephants', 1, 0, 3],
                ['Tigers', 0, 1, 0]
            ],
            $actualStandings
        );
    }

}
