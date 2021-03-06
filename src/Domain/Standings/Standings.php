<?php
declare(strict_types=1);

namespace BallGame\Domain\Standings;

use \BallGame\Domain\Match\Match;
use \BallGame\Domain\TeamPosition\TeamPosition;
use \BallGame\Domain\RuleBook\RuleBookInterface;
use \BallGame\Infrastructure\Repository\MatchRepository;

class Standings
{
    /**
     * @var MatchRepository
     */
    protected $matchRepository;

    /**
     * @var TeamPosition[]
     */
    protected $teamPositions;

    /**
     * @var RuleBookInterface
     */
    protected $ruleBook;

    public function __construct(RuleBookInterface $ruleBook, MatchRepository $matchRepository) {
        $this->ruleBook = $ruleBook;
        $this->matchRepository = $matchRepository;
    }

    public function record(Match $match)
    {
        $this->matchRepository->save($match);
    }

    public function getSortedStandings()
    {
        foreach ($this->matchRepository->findAll() as $match) {
            if (!isset($this->teamPositions[spl_object_hash($match->getTeamOne())])) {
                $this->teamPositions[spl_object_hash($match->getTeamOne())] = new TeamPosition($match->getTeamOne());
            }
            $teamOnePosition = $this->teamPositions[spl_object_hash($match->getTeamOne())];

            if (!isset($this->teamPositions[spl_object_hash($match->getTeamTwo())])) {
                $this->teamPositions[spl_object_hash($match->getTeamTwo())] = new TeamPosition($match->getTeamTwo());
            }
            $teamTwoPosition = $this->teamPositions[spl_object_hash($match->getTeamTwo())];

            if ($match->getTeamOneScore() > $match->getTeamTwoScore()) {
                $teamOnePosition->recordWin();
            }

            if ($match->getTeamOneScore() < $match->getTeamTwoScore()) {
                $teamTwoPosition->recordWin();
            }

            $teamOnePosition->recordPointsScored($match->getTeamOneScore());
            $teamOnePosition->recordPointsAgainst($match->getTeamTwoScore());

            $teamTwoPosition->recordPointsScored($match->getTeamTwoScore());
            $teamTwoPosition->recordPointsAgainst($match->getTeamOneScore());

            uasort($this->teamPositions, [$this->ruleBook, 'decide']);

            $finalStandings = [];
            foreach ($this->teamPositions as $teamPosition) {
                $finalStandings[] = [
                    $teamPosition->getTeam()->getName(),
                    $teamPosition->getPointsScored(),
                    $teamPosition->getPointsAgainst(),
                    $teamPosition->getPoints()
                ];
            }

        }
        return $finalStandings;
    }

    public function getWonStandings()
    {
        foreach ($this->matchRepository->findAll() as $match) {
            if (!isset($this->teamPositions[sha1($match->getTeamOne()->getName())])) {
                $this->teamPositions[sha1($match->getTeamOne()->getName())] = new TeamPosition($match->getTeamOne());
            }
            $teamOnePosition = $this->teamPositions[sha1($match->getTeamOne()->getName())];

            if (!isset($this->teamPositions[sha1($match->getTeamTwo()->getName())])) {
                $this->teamPositions[sha1($match->getTeamTwo()->getName())] = new TeamPosition($match->getTeamTwo());
            }
            $teamTwoPosition = $this->teamPositions[sha1($match->getTeamTwo()->getName())];

            if ($match->getTeamOneScore() > $match->getTeamTwoScore()) {
                $teamOnePosition->recordWin();
            }

            if ($match->getTeamOneScore() < $match->getTeamTwoScore()) {
                $teamTwoPosition->recordWin();
            }

            // uasort($this->teamPositions, [$this->ruleBook, 'decide']);

            $finalStandings = [];
            foreach ($this->teamPositions as $teamPosition) {
                $finalStandings[] = [
                    $teamPosition->getTeam()->getName(),
                    $teamPosition->getWins()
                ];
            }
        }

        return $finalStandings;
    }
}
