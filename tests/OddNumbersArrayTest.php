<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\GetTheBallRolling;
use PHPUnit\Framework\TestCase;

class OddNumbersArrayTest extends TestCase
{
    public function setUp() {
        $this->odd = new OddNumbersArray();
    }

    public function skipSampleOddOccurences() {
        $this->assertEquals(7, $this->odd->getOddOccurences([ 9, 3, 9, 3, 9, 7, 9 ]));
    }

    public function skipOddElementIsFirst() {
        $this->assertEquals(1, $this->odd->getOddOccurences([ 1, 2, 2, 3, 3, 4, 4 ]));
    }

    public function skipOddElementIsLast() {
        $this->assertEquals(4, $this->odd->getOddOccurences([ 1, 1, 2, 2, 3, 3, 4 ]));
    }

    public function skipThereIsNoOddElements() {
        $this->assertEquals(4, $this->odd->getOddOccurences([ 1, 1, 2, 2, 3, 3, 3 ]));
    }
}
