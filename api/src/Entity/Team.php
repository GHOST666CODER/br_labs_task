<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Sport", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TeamAliases", mappedBy="team", orphanRemoval=true)
     */
    private $teamAliases;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GameData", mappedBy="team1", orphanRemoval=true)
     */
    private $gameData1;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GameData", mappedBy="team2", orphanRemoval=true)
     */
    private $gameData2;

    public function __construct()
    {
        $this->teamAliases = new ArrayCollection();
        $this->gameData1 = new ArrayCollection();
        $this->gameData2 = new ArrayCollection();
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
     * @return Collection|TeamAliases[]
     */
    public function getTeamAliases(): Collection
    {
        return $this->teamAliases;
    }

    public function addTeamAlias(TeamAliases $teamAlias): self
    {
        if (!$this->teamAliases->contains($teamAlias)) {
            $this->teamAliases[] = $teamAlias;
            $teamAlias->setTeam($this);
        }

        return $this;
    }

    public function removeTeamAlias(TeamAliases $teamAlias): self
    {
        if ($this->teamAliases->contains($teamAlias)) {
            $this->teamAliases->removeElement($teamAlias);
            // set the owning side to null (unless already changed)
            if ($teamAlias->getTeam() === $this) {
                $teamAlias->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GameData[]
     */
    public function getGameData1(): Collection
    {
        return $this->gameData1;
    }

    public function addGameData1(GameData $gameData1): self
    {
        if (!$this->gameData1->contains($gameData1)) {
            $this->gameData1[] = $gameData1;
            $gameData1->setTeam1($this);
        }

        return $this;
    }

    public function removeGameData1(GameData $gameData1): self
    {
        if ($this->gameData1->contains($gameData1)) {
            $this->gameData1->removeElement($gameData1);
            // set the owning side to null (unless already changed)
            if ($gameData1->getTeam1() === $this) {
                $gameData1->setTeam1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GameData[]
     */
    public function getGameData2(): Collection
    {
        return $this->gameData2;
    }

    public function addGameData2(GameData $gameData2): self
    {
        if (!$this->gameData2->contains($gameData2)) {
            $this->gameData2[] = $gameData2;
            $gameData2->setTeam2($this);
        }

        return $this;
    }

    public function removeGameData2(GameData $gameData2): self
    {
        if ($this->gameData2->contains($gameData2)) {
            $this->gameData2->removeElement($gameData2);
            // set the owning side to null (unless already changed)
            if ($gameData2->getTeam2() === $this) {
                $gameData2->setTeam2(null);
            }
        }

        return $this;
    }
}
