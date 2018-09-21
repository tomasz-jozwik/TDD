<?php
declare(strict_types=1);

namespace BallGame\Tests\RuleBook;

use \BallGame\RuleBook\SimpleRuleBook;
use \BallGame\TeamPosition\TeamPosition;
use \BallGame\Team\Team;
use PHPUnit\Framework\TestCase;

class SimpleRuleBookTest extends TestCase
{
    protected $teamAPosition;
    protected $teamBPosition;
    /**
     * @var SimpleRuleInterface
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

    public function testDecideReturnsGreaterThanZeroWhenFirstPositionIsGreaterThanSecond() {
        $this->teamAPosition->method('getPoints')->willReturn(10);
        $this->teamBPosition->method('getPoints')->willReturn(1);

        $this->assertSame(-1, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsGreaterThanZeroWhenSecondPositionIsGreaterThanFirst() {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPoints')->willReturn(10);

        $this->assertSame(1, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsZeroWhenBothPositionsAreTheSame() {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPoints')->willReturn(1);

        $this->assertSame(0, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }
}
