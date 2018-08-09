<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayedSongsRepository")
 */
class PlayedSongs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added_at;

    /**
     * @ORM\OneToOne(targetEntity="Mass")
     * @ORM\JoinColumn(name="mass_id", referencedColumnName="id")
     */
    private $mass;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlayedSongsSong", mappedBy="playedSongs")
     */
    private $playedSongsSong;


    public function getId()
    {
        return $this->id;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->added_at;
    }

    public function setAddedAt(\DateTimeInterface $added_at): self
    {
        $this->added_at = $added_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMass()
    {
        return $this->mass;
    }

    /**
     * @param mixed $mass
     */
    public function setMass($mass): void
    {
        $this->mass = $mass;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return Collection|PlayedSongsSong[]
     */
    public function getPlayedSongsSong(): Collection
    {
        return $this->playedSongsSong;
    }

    public function addPlayedSongsSong(PlayedSongsSong $playedSongsSong): self
    {
        if (!$this->playedSongsSong->contains($playedSongsSong)) {
            $this->playedSongsSong[] = $playedSongsSong;
            $playedSongsSong->setPlayedSongs($this);
        }

        return $this;
    }

    public function removePlayedSongsSong(PlayedSongsSong $playedSongsSong): self
    {
        if ($this->playedSongsSong->contains($playedSongsSong)) {
            $this->playedSongsSong->removeElement($playedSongsSong);
            // set the owning side to null (unless already changed)
            if ($playedSongsSong->getPlayedSongs() === $this) {
                $playedSongsSong->setPlayedSongs(null);
            }
        }

        return $this;
    }

    /**
     * @param ArrayCollection $collection
     */
    public function setPlayedSongsSong(ArrayCollection $collection): void
    {
        $this->playedSongsSong = $collection;
    }

    public function __construct() {
        $this->playedSongsSong = new ArrayCollection();
    }

    public static $types = [
        10 => ['Wejście', 'W'],
        12 => ['Przygotowanie darów', 'Pd'],
        14 => ['Komunia 1', 'K1'],
        15 => ['Komunia 2', 'K2'],
        18 => ['Uwielbienie', 'U'],
        20 => ['Zakończenie', 'Z'],
    ];
}
