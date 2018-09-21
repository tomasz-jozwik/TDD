<?php
declare(strict_types=1);

namespace BallGame\Tests;

use BallGame\GetTheBallRolling;
use PHPUnit\Framework\TestCase;

class GetTheBallRollingTest extends TestCase
{
    public function setUp() {
        $this->ball = GetTheBallRolling::create('Hello');
    }

    public function testGetNameReturnsCreatedName()
    {
        $this->assertEquals('Hello', $this->ball->getName());
    }

    public function testBinaryGapWhenSomethingFunkyHappens()
    {
        $this->assertEquals(0, $this->ball->getBinaryGap('asdf'));
        $this->assertEquals(0, $this->ball->getBinaryGap(''));
    }

    public function testBinaryGapWhenThereIsNoGaps()
    {
        $this->assertEquals(0, $this->ball->getBinaryGap('1000000'));
        $this->assertEquals(0, $this->ball->getBinaryGap('0000001'));
        $this->assertEquals(0, $this->ball->getBinaryGap('1111111'));
    }

    public function testBinaryGapWhenThereIsOneGap()
    {
        $this->assertEquals(5, $this->ball->getBinaryGap('1000001'));
    }

    public function testBinaryGapWhenThereAreManyGaps()
    {
        $this->assertEquals(1, $this->ball->getBinaryGap('1101101'));
    }

    public function testBinaryGapWhenThereAreTwoAndFirstOneIsBigger() {
        $this->assertEquals(2, $this->ball->getBinaryGap('1001101'));
    }

    public function testBinaryGapWhenThereAreTwoAndSecondOneIsBigger() {
        $this->assertEquals(3, $this->ball->getBinaryGap('10110001'));
    }

    public function itestSampleOddOccurences() {
        $this->assertEquals(7, $this->ball->getOddOccurences([ 9, 3, 9, 3, 9, 7, 9 ]));
    }

    public function itestOddElementIsFirst() {
        $this->assertEquals(1, $this->ball->getOddOccurences([ 1, 2, 2, 3, 3, 4, 4 ]));
    }

    public function itestOddElementIsLast() {
        $this->assertEquals(4, $this->ball->getOddOccurences([ 1, 1, 2, 2, 3, 3, 4 ]));
    }

    public function itestThereIsNoOddElements() {
        $this->assertEquals(4, $this->ball->getOddOccurences([ 1, 1, 2, 2, 3, 3, 3 ]));
    }
}
