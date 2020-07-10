<?php

namespace App\Entity;

use App\Repository\EdgeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EdgeRepository::class)
 */
class Edge
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\Node")
     */
    private $s;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="App\Entity\Node")
     */
    private $t;

    public function getS(): ?int
    {
        return $this->s;
    }

    public function setS(int $s): self
    {
        $this->s = $s;

        return $this;
    }

    public function getT(): ?int
    {
        return $this->t;
    }

    public function setT(int $t): self
    {
        $this->t = $t;

        return $this;
    }
}
