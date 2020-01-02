<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\SportRepository")
 */
class Sport
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
     * @ORM\OneToMany(targetEntity="App\Entity\SportAliases", mappedBy="sport", orphanRemoval=true)
     */
    private $sportAliases;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\League", mappedBy="sport", orphanRemoval=true)
     */
    private $leagues;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Team", mappedBy="sport", orphanRemoval=true)
     */
    private $teams;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GameData", mappedBy="sport", orphanRemoval=true)
     */
    private $gameData;

    public function __construct()
    {
        $this->sportAliases = new ArrayCollection();
        $this->leagues = new ArrayCollection();
        $this->teams = new ArrayCollection();
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

    /**
     * @return Collection|SportAliases[]
     */
    public function getSportAliases(): Collection
    {
        return $this->sportAliases;
    }

    public function addSportAlias(SportAliases $sportAlias): self
    {
        if (!$this->sportAliases->contains($sportAlias)) {
            $this->sportAliases[] = $sportAlias;
            $sportAlias->setSport($this);
        }

        return $this;
    }

    public function removeSportAlias(SportAliases $sportAlias): self
    {
        if ($this->sportAliases->contains($sportAlias)) {
            $this->sportAliases->removeElement($sportAlias);
            // set the owning side to null (unless already changed)
            if ($sportAlias->getSport() === $this) {
                $sportAlias->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|League[]
     */
    public function getLeagues(): Collection
    {
        return $this->leagues;
    }

    public function addLeague(League $league): self
    {
        if (!$this->leagues->contains($league)) {
            $this->leagues[] = $league;
            $league->setSport($this);
        }

        return $this;
    }

    public function removeLeague(League $league): self
    {
        if ($this->leagues->contains($league)) {
            $this->leagues->removeElement($league);
            // set the owning side to null (unless already changed)
            if ($league->getSport() === $this) {
                $league->setSport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams[] = $team;
            $team->setSport($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams->contains($team)) {
            $this->teams->removeElement($team);
            // set the owning side to null (unless already changed)
            if ($team->getSport() === $this) {
                $team->setSport(null);
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
            $gameData->setSport($this);
        }

        return $this;
    }

    public function removeGameData(GameData $gameData): self
    {
        if ($this->gameData->contains($gameData)) {
            $this->gameData->removeElement($gameData);
            // set the owning side to null (unless already changed)
            if ($gameData->getSport() === $this) {
                $gameData->setSport(null);
            }
        }

        return $this;
    }
}
