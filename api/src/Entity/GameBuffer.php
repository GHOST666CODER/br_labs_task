<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ApiResource(
 *     collectionOperations={
 *     "get",
 *     "post" ={"method"="POST", "route_name"="post_game_buffer"}}
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\GameBufferRepository")
 */
class GameBuffer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameData", inversedBy="gameBuffer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gameData;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source", inversedBy="gameBuffers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $language;

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

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }
}
