<?php
declare(strict_types=1);

namespace BallGame\Tests\Domain\RuleBook;

use \BallGame\Domain\RuleBook\SimpleRuleBook;
use \BallGame\Domain\TeamPosition\TeamPosition;
use \BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class SimpleRuleBookTest extends TestCase
{
    protected $teamAPosition;
    protected $teamBPosition;

    /**
     * @var RuleBookInterface
     */
    protected $simpleRuleBook;

    public function setUp() {
        $this->teamAPosition = $this->getMockBuilder(TeamPosition::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->teamBPosition = $this->getMockBuilder(TeamPosition::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->simpleRuleBook = new SimpleRuleBook();
    }

    public function testDecideReturnsGreaterThanZeroWhenFirstPositionPointsAreGreaterThanSecond() {
        $this->teamAPosition->method('getPoints')->willReturn(10);
        $this->teamBPosition->method('getPoints')->willReturn(1);

        $this->assertSame(-1, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsGreaterThanZeroWhenSecondPositionPointsAreGreaterThanFirst() {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPoints')->willReturn(10);

        $this->assertSame(1, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsZeroWhenBothPositionPointsAreTheSame() {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPoints')->willReturn(1);

        $this->assertSame(0, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }
}
