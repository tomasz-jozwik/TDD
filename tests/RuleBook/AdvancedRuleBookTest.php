<?php
declare(strict_types=1);

namespace BallGame\Tests\RuleBook;

use \BallGame\RuleBook\AdvancedRuleBook;
use \BallGame\TeamPosition\TeamPosition;
use \BallGame\Team\Team;
use PHPUnit\Framework\TestCase;

class AdvancedRuleBookTest extends TestCase
{
    protected $teamAPosition;
    protected $teamBPosition;

    /**
     * @var RuleBookInterface
     */
    protected $advancedRuleBook;

    public function setUp() {
        $this->teamAPosition = $this->getMockBuilder(TeamPosition::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->teamBPosition = $this->getMockBuilder(TeamPosition::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->advancedRuleBook = new AdvancedRuleBook();
    }

    public function testDecideReturnsGreaterThanZeroWhenFirstPositionPointsAreGreaterThanSecond() {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamAPosition->method('getPointsScored')->willReturn(10);

        $this->teamBPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPointsScored')->willReturn(1);

        $this->assertSame(-1, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsGreaterThanZeroWhenSecondPositionPointsAreGreaterThanFirst() {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamAPosition->method('getPointsScored')->willReturn(1);

        $this->teamBPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPointsScored')->willReturn(10);

        $this->assertSame(1, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsZeroWhenBothPositionPointsAreTheSame() {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamAPosition->method('getPointsScored')->willReturn(10);

        $this->teamBPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPointsScored')->willReturn(10);

        $this->assertSame(0, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }
}
