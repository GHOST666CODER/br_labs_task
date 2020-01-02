<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Controller\GetRandomGameController;
use App\Filter\GetRandomFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ApiResource(itemOperations={
 *     "get",
 *     "get_random_game" =
 *     {"method"="GET", "route_name"="get_random_game"},
 *     "delete",
 *     "put",
 *     "patch",
 *     },
 *  attributes={"pagination_items_per_page"=1})
 * @ApiFilter(DateFilter::class, properties={"startTime"})
 * @ApiFilter(SearchFilter::class, properties={"gameData.gameBuffer.source": "exact"})
 * @ApiFilter(GetRandomFilter::class)
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\GameData", mappedBy="game", cascade={"persist", "remove"})
     */
    private $gameData;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGameData(): ?GameData
    {
        return $this->gameData;
    }

    public function setGameData(?GameData $gameData): self
    {
        $this->gameData = $gameData;

        // set (or unset) the owning side of the relation if necessary
        $newGame = null === $gameData ? null : $this;
        if ($gameData->getGame() !== $newGame) {
            $gameData->setGame($newGame);
        }

        return $this;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startTime = $startTime;

        return $this;
    }
}
