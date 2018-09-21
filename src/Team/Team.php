<?php
declare(strict_types=1);

namespace BallGame\Team;

class Team
{
    /**
     * @var string
     */
    private $name;

    private function __construct($name) {
        $this->name = $name;
    }

    public function create(string $name) {
        return new self($name);
    }

    public function getName() : string {
        return $this->name;
    }
}
