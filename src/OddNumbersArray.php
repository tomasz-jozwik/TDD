<?php
declare(strict_types=1);

namespace BallGame;

class OddNumbersArray
{
    public function getOddOccurences(array $input) : int
    {
        // n^2 cost...
        $evens = [];
        foreach ($input as $a) {
            foreach ($input as $b) {
                if ($a === $b) {
                    $evens[] = $a;
                }
            }
        }

        //var_dump($evens);
        //echo "\n";

        return count(array_diff($evens, $input));
    }
}
