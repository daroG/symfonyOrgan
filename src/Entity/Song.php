<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SongRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Song
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $added_at;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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
     * @ORM\PrePersist
     */
    public function onPrePersistSetRegistrationDate()
    {
        $this->added_at = new \DateTime();
    }

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="song_tag",
     *     joinColumns={@JoinColumn(name="song_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="tag_id", referencedColumnName="id")}
     *     )
     */
    private $tags;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlayedSongsSong", mappedBy="song", orphanRemoval=true)
     */
    private $playedSongsSongs;

    public function getTags(){
        return $this->tags;
    }

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->playedSongsSongs = new ArrayCollection();
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)){
            $this->tags->add($tag);
        }

        return $this;
    }

    /**
     * @return Collection|PlayedSongsSong[]
     */
    public function getPlayedSongsSongs(): Collection
    {
        return $this->playedSongsSongs;
    }

    public function addPlayedSongsSong(PlayedSongsSong $playedSongsSong): self
    {
        if (!$this->playedSongsSongs->contains($playedSongsSong)) {
            $this->playedSongsSongs[] = $playedSongsSong;
            $playedSongsSong->setSong($this);
        }

        return $this;
    }

    public function removePlayedSongsSong(PlayedSongsSong $playedSongsSong): self
    {
        if ($this->playedSongsSongs->contains($playedSongsSong)) {
            $this->playedSongsSongs->removeElement($playedSongsSong);
            // set the owning side to null (unless already changed)
            if ($playedSongsSong->getSong() === $this) {
                $playedSongsSong->setSong(null);
            }
        }

        return $this;
    }
}
