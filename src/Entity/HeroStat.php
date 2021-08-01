<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\HeroStatRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HeroStatRepository::class)
 */
class HeroStat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Hero::class, inversedBy="heroStat", cascade={"persist", "remove"})
     */
    private $hero;

    /**
     * @ORM\Column(type="integer", options={"default": 1})
     */
    private $strength = 1;

    /**
     * @ORM\Column(type="integer", options={"default": 1})
     */
    private $agility = 1;

    /**
     * @ORM\Column(type="integer", options={"default": 1})
     */
    private $stamina = 1;

    /**
     * @ORM\Column(type="float", options={"default": 0})
     */
    private $crit = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHero(): ?Hero
    {
        return $this->hero;
    }

    public function setHero(?Hero $hero): self
    {
        $this->hero = $hero;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getAgility(): ?int
    {
        return $this->agility;
    }

    public function setAgility(int $agility): self
    {
        $this->agility = $agility;

        return $this;
    }

    public function getStamina(): ?int
    {
        return $this->stamina;
    }

    public function setStamina(int $stamina): self
    {
        $this->stamina = $stamina;

        return $this;
    }

    public function getCrit(): ?float
    {
        return $this->crit;
    }

    public function setCrit(float $crit): self
    {
        $this->crit = $crit;

        return $this;
    }
}
