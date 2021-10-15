<?php

declare(strict_types=1);

namespace Yatzy;

class Yatzy
{
    public static function chance(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        return $d1 + $d2 + $d3 + $d4 + $d5;
    }

    public static function yatzyScore(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        if (! in_array(5, $counts, true)) {
            return 0;
        }
        return 50;
    }

    public static function ones(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        return $counts[0];
    }

    public static function twos(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        return $counts[1] * 2;
    }

    public static function threes(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        return $counts[2] * 3;
    }

    public static function fours(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        return $counts[3] * 4;
    }

    public static function fives(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        return $counts[4] * 5;
    }

    public static function sixes(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        return $counts[5] * 6;
    }

    public static function scorePair(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        if (! in_array(2, $counts, true)) {
            return 0;
        }
        for ($at = 0; $at !== 6; ++$at) {
            if ($counts[6 - $at - 1] === 2) {
                return (6 - $at) * 2;
            }
        }
        return 0;
    }

    public static function twoPair(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = self::getTallies($d1, $d2, $d3, $d4, $d5);
        $n      = 0;
        $score  = 0;
        for ($i = 0; $i !== 6; ++$i) {
            if ($counts[6 - $i - 1] >= 2) {
                ++$n;
                $score += (6 - $i);
            }
        }

        if ($n !== 2) {
            return 0;
        }
        return $score * 2;
    }

    public static function threeOfAKind(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $t = self::getTallies($d1, $d2, $d3, $d4, $d5);
        for ($i = 0; $i !== 6; ++$i) {
            if ($t[$i] >= 3) {
                return ($i + 1) * 3;
            }
        }
        return 0;
    }

    public static function smallStraight(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $tallies = self::getTallies($d1, $d2, $d3, $d4, $d5);
        if ($tallies[0] !== 1 || $tallies[1] !== 1 || $tallies[2] !== 1 || $tallies[3] !== 1 || $tallies[4] !== 1) {
            return 0;
        }

        return 15;
    }

    public static function largeStraight(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $tallies = self::getTallies($d1, $d2, $d3, $d4, $d5);

        if ($tallies[1] !== 1 || $tallies[2] !== 1 || $tallies[3] !== 1 || $tallies[4] !== 1 || $tallies[5] !== 1) {
            return 0;
        }
        return 20;
    }

    public static function fullHouse(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $onePair  = false;
        $pair_at  = 0;
        $three    = false;
        $three_at = 0;

        $tallies = self::getTallies($d1, $d2, $d3, $d4, $d5);

        foreach (range(0, 5) as $i) {
            if ($tallies[$i] === 2) {
                $onePair = true;
                $pair_at = $i + 1;
            }
            if ($tallies[$i] === 3) {
                $three    = true;
                $three_at = $i + 1;
            }
        }

        if (! $onePair || ! $three) {
            return 0;
        }

        return $pair_at * 2 + $three_at * 3;
    }

    /**
     * @return int[]
     */
    public static function getTallies(int $d1, int $d2, int $d3, int $d4, int $d5): array
    {
        $tallies = array_fill(0, 6, 0);
        ++$tallies[$d1 - 1];
        ++$tallies[$d2 - 1];
        ++$tallies[$d3 - 1];
        ++$tallies[$d4 - 1];
        ++$tallies[$d5 - 1];
        return $tallies;
    }
}
