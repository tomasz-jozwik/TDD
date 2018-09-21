<?php
declare(strict_types=1);

namespace BallGame;

class GetTheBallRolling
{
    private $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name)
    {
        return new self($name);
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getBinaryGap(string $number) : int
    {
        $binaryGaps = [0];
        $binaryGap = 0;

        for ($i = 0; $i < strlen($number); $i++) {
            $currentChar = $number[$i];
            $previousChar = ($i === 0) ? '' : $number[$i - 1];

            if ($currentChar == '0' && $previousChar == '1') { // Start treak
                $binaryGap++;
            }

            if ($currentChar == '0' && $previousChar == '0' && $binaryGap > 0) { // Streak
                $binaryGap++;
            }

            if ($currentChar == '1' && $previousChar == '0') { // Ending streak
                $binaryGaps[] = $binaryGap;
                $binaryGap = 0;
            }
        }

        /**
         *  $input = '110000010001';
         *  $pattern = '#(?:1+)(?<result>0+)(?:1+)#';
         *  preg_match_all($pattern, $input, $matches);
         *  var_dump($matches);
         */
        return max($binaryGaps);
    }

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
