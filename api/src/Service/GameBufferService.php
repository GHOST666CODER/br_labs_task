<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Sport;
use App\Entity\League;
use App\Entity\Team;
use App\Entity\GameBuffer;
use App\Entity\GameData;
use App\Entity\Game;
use App\Entity\Source;

class GameBufferService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function saveGameBuffer(array $gameInfo)
    {

        $sportRepository = $this->entityManager->getRepository(Sport::class);
        $leagueRepository = $this->entityManager->getRepository(League::class);
        $teamRepository = $this->entityManager->getRepository(Team::class);
        $sourceRepository = $this->entityManager->getRepository(Source::class);
        $gameDataRepository = $this->entityManager->getRepository(GameData::class);
        $gameBufferRepository = $this->entityManager->getRepository(GameBuffer::class);

        $sport = $sportRepository->findSportByNameOrAlias($gameInfo['sport']);
        $league = $leagueRepository->findLeagueByNameOrAlias($gameInfo['league']);
        $team1 = $teamRepository->findTeamByNameOrAlias($gameInfo['team1']);
        $team2 = $teamRepository->findTeamByNameOrAlias($gameInfo['team2']);
        $source = $sourceRepository->findOneBy(['name' => $gameInfo['source']]);
        $language = $gameInfo['language'];
        $startTime = new \DateTime($gameInfo['startTime']);

        $startTimeFrom = date_modify(new \DateTime($gameInfo['startTime']), '- 26 hours');
        $startTimeTo = date_modify(new \DateTime($gameInfo['startTime']), '+ 26 hours');

        $gameBuffer = new GameBuffer();
        $gameBuffer->setStartTime($startTime);
        $gameBuffer->setSource($source);
        $gameBuffer->setLanguage($language);

        $gameData = $gameDataRepository->findByParameters([
            'sport' => $sport,
            'league' => $league,
            'team1' => $team1,
            'team2' => $team2,
            'startTime' => $startTime
        ]);

        if ($gameData) {
            $gameData->addGameBuffer($gameBuffer);
            $game = $gameData->getGame();
        } else {
            $gameData = new GameData();
            $game = new Game();
            $gameData->setSport($sport);
            $gameData->setLeague($league);
            $gameData->setStartTimeFrom($startTimeFrom);
            $gameData->setStartTimeTo($startTimeTo);
            $gameData->setTeam1($team1);
            $gameData->setTeam2($team2);
            $gameData->addGameBuffer($gameBuffer);
            $gameData->setGame($game);
            $game->setStartTime($startTime);
        }

        $this->entityManager->persist($gameBuffer);
        $this->entityManager->persist($gameData);

        $this->entityManager->flush();

        $probableStartTime = $gameBufferRepository->findMostDuplicatedStartTime($gameData);
        $game->setStartTime($probableStartTime[0]['startTime']);
        $this->entityManager->persist($game);

        $this->entityManager->flush();

        return new JsonResponse($probableStartTime, 201);
    }
}
