<?php
declare(strict_types=1);

namespace BallGame\Tests\Domain\Standings;

use \BallGame\Domain\Standings\Standings;
use \BallGame\Domain\Match\Match;
use \BallGame\Domain\Team\Team;
use \BallGame\Domain\TeamPosition\TeamPosition;
use \BallGame\Domain\RuleBook\AdvancedRuleBook;
use \BallGame\Infrastructure\Repository\MatchRepository;
use \PHPUnit\Framework\TestCase;

class StandingsWonTest extends TestCase
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
        $this->ruleBook = new AdvancedRuleBook();
        $this->matchRepository = $this->getMockBuilder(MatchRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->standings = new Standings($this->ruleBook, $this->matchRepository);
    }

    /**
     * @group integration
     */
    public function testGetStandingsReturnsWonStandings() {
        // Given
        $this->matchRepository->method('findAll')->willReturn([
            Match::create(
                Team::create('Tigers'), Team::create('Elephants'), 2, 1
            ),
            Match::create(
                Team::create('Tigers'), Team::create('Elephants'), 2, 1
            ),
            Match::create(
                Team::create('Tigers'), Team::create('Elephants'), 1, 2
            ),
        ]);

        // When
        $actualStandings = $this->standings->getWonStandings();

        // Then
        $this->assertSame(
            [
                ['Tigers', 2],
                ['Elephants', 1]
            ],
            $actualStandings
        );
    }
}
