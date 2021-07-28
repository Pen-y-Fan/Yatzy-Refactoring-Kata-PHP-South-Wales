<?php

declare(strict_types=1);

namespace Yatzy\Tests;

use PHPUnit\Framework\TestCase;
use Yatzy\Yatzy;

class YatzyTest extends TestCase
{
    public function testChanceScoresSumOfAllDice(): void
    {
        self::assertSame(15, Yatzy::chance(2, 3, 4, 5, 1));
        self::assertSame(16, Yatzy::chance(3, 3, 4, 5, 1));
    }

    public function testYatzyScores50(): void
    {
        self::assertSame(50, Yatzy::yatzyScore(4, 4, 4, 4, 4));
        self::assertSame(50, Yatzy::yatzyScore(6, 6, 6, 6, 6));
        self::assertSame(0, Yatzy::yatzyScore(6, 6, 6, 6, 3));
    }

    public function testOnes(): void
    {
        self::assertSame(1, Yatzy::ones(1, 2, 3, 4, 5));
        self::assertSame(2, Yatzy::ones(1, 2, 1, 4, 5));
        self::assertSame(0, Yatzy::ones(6, 2, 2, 4, 5));
        self::assertSame(4, Yatzy::ones(1, 2, 1, 1, 1));
    }

    public function testTwos(): void
    {
        self::assertSame(4, Yatzy::twos(1, 2, 3, 2, 6));
        self::assertSame(10, Yatzy::twos(2, 2, 2, 2, 2));
    }

    public function testThrees(): void
    {
        self::assertSame(6, Yatzy::threes(1, 2, 3, 2, 3));
        self::assertSame(12, Yatzy::threes(2, 3, 3, 3, 3));
    }

    public function testFours(): void
    {
        self::assertSame(12, Yatzy::fours(4, 4, 4, 5, 5));
        self::assertSame(8, Yatzy::fours(4, 4, 5, 5, 5));
        self::assertSame(4, Yatzy::fours(4, 5, 5, 5, 5));
    }

    public function testFives(): void
    {
        self::assertSame(10, Yatzy::fives(4, 4, 4, 5, 5));
        self::assertSame(15, Yatzy::fives(4, 4, 5, 5, 5));
        self::assertSame(20, Yatzy::fives(4, 5, 5, 5, 5));
    }

    public function testSixes(): void
    {
        self::assertSame(0, Yatzy::sixes(4, 4, 4, 5, 5));
        self::assertSame(6, Yatzy::sixes(4, 4, 6, 5, 5));
        self::assertSame(18, Yatzy::sixes(6, 5, 6, 6, 5));
    }

    public function testOnePair(): void
    {
        self::assertSame(6, Yatzy::scorePair(3, 4, 3, 5, 6));
        self::assertSame(10, Yatzy::scorePair(5, 3, 3, 3, 5));
        self::assertSame(12, Yatzy::scorePair(5, 3, 6, 6, 5));
        self::assertSame(0, Yatzy::scorePair(1, 2, 3, 4, 5));
    }

    public function testTwoPair(): void
    {
        self::assertSame(16, Yatzy::twoPair(3, 3, 5, 4, 5));
        self::assertSame(18, Yatzy::twoPair(3, 3, 6, 6, 6));
        self::assertSame(0, Yatzy::twoPair(3, 3, 6, 5, 4));
    }

    public function testThreeOfAKind(): void
    {
        self::assertSame(9, Yatzy::threeOfAKind(3, 3, 3, 4, 5));
        self::assertSame(15, Yatzy::threeOfAKind(5, 3, 5, 4, 5));
        self::assertSame(9, Yatzy::threeOfAKind(3, 3, 3, 2, 1));
        self::assertSame(0, Yatzy::threeOfAKind(1, 2, 3, 2, 1));
    }

    public function testSmallStraight(): void
    {
        self::assertSame(15, Yatzy::smallStraight(1, 2, 3, 4, 5));
        self::assertSame(15, Yatzy::smallStraight(2, 3, 4, 5, 1));
        self::assertSame(0, Yatzy::smallStraight(1, 2, 2, 4, 5));
    }

    public function testLargeStraight(): void
    {
        self::assertSame(20, Yatzy::largeStraight(6, 2, 3, 4, 5));
        self::assertSame(20, Yatzy::largeStraight(2, 3, 4, 5, 6));
        self::assertSame(0, Yatzy::largeStraight(1, 2, 2, 4, 5));
    }

    public function testFullHouse(): void
    {
        self::assertSame(18, Yatzy::fullHouse(6, 2, 2, 2, 6));
        self::assertSame(0, Yatzy::fullHouse(2, 3, 4, 5, 6));
    }
}
