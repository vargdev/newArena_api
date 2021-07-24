<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HeroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeroRepository::class)
 */
#[ApiResource]
class Hero
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="hero", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=63)
     */
    private $username;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     */
    private $exp = 0;

    /**
     * @ORM\Column(type="integer", options={"default": 1})
     */
    private ?int $level = 1;

    /**
     * @ORM\OneToOne(targetEntity=HeroStat::class, mappedBy="hero", cascade={"persist", "remove"})
     */
    private ?HeroStat $heroStat = null;

    public function __construct()
    {
        $this->heroStat = new HeroStat();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getExp(): ?int
    {
        return $this->exp;
    }

    public function setExp(int $exp): self
    {
        $this->exp = $exp;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getHeroStat(): ?HeroStat
    {
        return $this->heroStat;
    }

    public function setHeroStat(HeroStat $heroStat): self
    {
        // unset the owning side of the relation if necessary
        if ($heroStat === null && $this->heroStat !== null) {
            $this->heroStat->setHero(null);
        }

        // set the owning side of the relation if necessary
        if ($heroStat !== null && $heroStat->getHero() !== $this) {
            $heroStat->setHero($this);
        }

//        $this->heroStat = $heroStat;
//        $heroStat->setHero($this);

        $this->heroStat = $heroStat;

        return $this;
    }
}
