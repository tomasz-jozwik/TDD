<?php
declare(strict_types=1);

namespace BallGame\Domain\Team;

use BallGame\Domain\Team\BadTeamNameException;

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
        if (empty($name)) {
            throw new BadTeamNameException('Team needs a name');
        }

        return new self($name);
    }

    public function getName() : string {
        return $this->name;
    }
}
