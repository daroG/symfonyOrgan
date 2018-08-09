<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayedSongsSongRepository")
 * @ORM\Table(name="playedsongs_song")
 */
class PlayedSongsSong
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Song", inversedBy="playedSongsSongs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $song;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayedSongs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $PlayedSongs;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayedSongs", inversedBy="playedSongsSong")
     * @ORM\JoinColumn(nullable=false)
     */
    private $playedSongs;

    public function getId()
    {
        return $this->id;
    }

    public function getSong(): ?Song
    {
        return $this->song;
    }

    public function setSong(?Song $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getPlayedSongs(): ?PlayedSongs
    {
        return $this->PlayedSongs;
    }

    public function setPlayedSongs(?PlayedSongs $PlayedSongs): self
    {
        $this->PlayedSongs = $PlayedSongs;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }
}
