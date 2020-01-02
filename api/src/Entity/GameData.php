<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\GameDataRepository")
 */
class GameData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sport", inversedBy="gameData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\League", inversedBy="gameData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $league;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="gameData1")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Team", inversedBy="gameData2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $team2;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Game", inversedBy="gameData", cascade={"persist", "remove"})
     */
    private $game;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GameBuffer", mappedBy="gameData", orphanRemoval=true)
     */
    private $gameBuffer;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTimeFrom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTimeTo;


    public function __construct()
    {
        $this->gameBuffer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSport(): ?Sport
    {
        return $this->sport;
    }

    public function setSport(?Sport $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getLeague(): ?League
    {
        return $this->league;
    }

    public function setLeague(?League $league): self
    {
        $this->league = $league;

        return $this;
    }

    public function getTeam1(): ?Team
    {
        return $this->team1;
    }

    public function setTeam1(?Team $team1): self
    {
        $this->team1 = $team1;

        return $this;
    }

    public function getTeam2(): ?Team
    {
        return $this->team2;
    }

    public function setTeam2(?Team $team2): self
    {
        $this->team2 = $team2;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Collection|GameBuffer[]
     */
    public function getGameBuffer(): Collection
    {
        return $this->gameBuffer;
    }

    public function addGameBuffer(GameBuffer $gameBuffer): self
    {
        if (!$this->gameBuffer->contains($gameBuffer)) {
            $this->gameBuffer[] = $gameBuffer;
            $gameBuffer->setGameData($this);
        }

        return $this;
    }

    public function removeGameBuffer(GameBuffer $gameBuffer): self
    {
        if ($this->gameBuffer->contains($gameBuffer)) {
            $this->gameBuffer->removeElement($gameBuffer);
            // set the owning side to null (unless already changed)
            if ($gameBuffer->getGameData() === $this) {
                $gameBuffer->setGameData(null);
            }
        }

        return $this;
    }

    public function getStartTimeFrom(): ?\DateTimeInterface
    {
        return $this->startTimeFrom;
    }

    public function setStartTimeFrom(\DateTimeInterface $startTimeFrom): self
    {
        $this->startTimeFrom = $startTimeFrom;

        return $this;
    }

    public function getStartTimeTo(): ?\DateTimeInterface
    {
        return $this->startTimeTo;
    }

    public function setStartTimeTo(\DateTimeInterface $startTimeTo): self
    {
        $this->startTimeTo = $startTimeTo;

        return $this;
    }

}
