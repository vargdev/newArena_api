<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LevelRepository::class)
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $level;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $exp;

    /**
     * @ORM\Column(type="integer", options={"default": 2})
     */
    private ?int $stat = 2;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getExp(): ?int
    {
        return $this->exp;
    }

    public function setExp(int $exp): self
    {
        $this->exp = $exp;

        return $this;
    }

    public function getStat(): ?int
    {
        return $this->stat;
    }

    public function setStat(int $stat): self
    {
        $this->stat = $stat;

        return $this;
    }
}
