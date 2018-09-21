<?php
declare(strict_types=1);

namespace BallGame\Tests\Domain;

use \BallGame\Domain\Standings\Standings;
use \BallGame\Domain\Match\Match;
use \BallGame\Domain\Team\Team;
use \BallGame\Domain\TeamPosition\TeamPosition;
use \BallGame\Domain\RuleBook\SimpleRuleBook;
use \BallGame\Infrastructure\Repository\MatchRepository;
use \PHPUnit\Framework\TestCase;

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

    /**
     * @var MatchRepository
     */
    protected $matchRepository;

    public function setUp() {
        $this->ruleBook = new SimpleRuleBook();
        //$this->matchRepository = new MatchRepository();
        $this->matchRepository = $this->getMockBuilder(MatchRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->standings = new Standings($this->ruleBook, $this->matchRepository);
    }

    /**
     * @group integration
     */
    public function testGetStandingsReturnsSortedLeagueStandings() {
        // Given
        $tigers = Team::create('Tigers');
        $elephants = Team::create('Elephants');
        $match = Match::create($tigers, $elephants, 2, 1);
        $this->standings->record($match);

        $this->matchRepository->method('findAll')->willReturn([$match]);

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

    /**
     * @group integration
     */
    public function testGetStandingsReturnsSortedLeagueStandingsWhenSecondTeamEndsUpInFirstPlace() {
        // Given
        $tigers = Team::create('Tigers');
        $elephants = Team::create('Elephants');
        $match = Match::create($tigers, $elephants, 0, 1);

        $this->standings->record($match);

        $this->matchRepository->method('findAll')->willReturn([$match]);

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

    public function testRecordSavesMatchInRepository()
    {
        $match = $this->getMockBuilder(Match::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->matchRepository
            ->expects($this->once())
            ->method('save');

        $this->standings->record($match);
    }
}
