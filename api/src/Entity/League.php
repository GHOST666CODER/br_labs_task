<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\LeagueRepository")
 */
class League
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sport", inversedBy="leagues")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LeagueAliases", mappedBy="league", orphanRemoval=true)
     */
    private $leagueAliases;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GameData", mappedBy="league", orphanRemoval=true)
     */
    private $gameData;

    public function __construct()
    {
        $this->leagueAliases = new ArrayCollection();
        $this->gameData = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    /**
     * @return Collection|LeagueAliases[]
     */
    public function getLeagueAliases(): Collection
    {
        return $this->leagueAliases;
    }

    public function addLeagueAlias(LeagueAliases $leagueAlias): self
    {
        if (!$this->leagueAliases->contains($leagueAlias)) {
            $this->leagueAliases[] = $leagueAlias;
            $leagueAlias->setLeague($this);
        }

        return $this;
    }

    public function removeLeagueAlias(LeagueAliases $leagueAlias): self
    {
        if ($this->leagueAliases->contains($leagueAlias)) {
            $this->leagueAliases->removeElement($leagueAlias);
            // set the owning side to null (unless already changed)
            if ($leagueAlias->getLeague() === $this) {
                $leagueAlias->setLeague(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GameData[]
     */
    public function getGameData(): Collection
    {
        return $this->gameData;
    }

    public function addGameData(GameData $gameData): self
    {
        if (!$this->gameData->contains($gameData)) {
            $this->gameData[] = $gameData;
            $gameData->setLeague($this);
        }

        return $this;
    }

    public function removeGameData(GameData $gameData): self
    {
        if ($this->gameData->contains($gameData)) {
            $this->gameData->removeElement($gameData);
            // set the owning side to null (unless already changed)
            if ($gameData->getLeague() === $this) {
                $gameData->setLeague(null);
            }
        }

        return $this;
    }
}
