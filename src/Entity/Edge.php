<?php

namespace App\Entity;

use App\Repository\EdgeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Annotations\IndexedReader;

/**
 * @ORM\Entity(repositoryClass=EdgeRepository::class)
 * @ORM\Table(indexes={@ORM\Index(name="sIndex", columns={"s"}), @ORM\Index(name="tIndex", columns={"t"})})
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

    /**
     * @return int|null
     */
    public function getS(): ?int
    {
        return $this->s;
    }

    /**
     * @param int $s
     * @return $this
     */
    public function setS(int $s): self
    {
        $this->s = $s;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getT(): ?int
    {
        return $this->t;
    }

    /**
     * @param int $t
     * @return $this
     */
    public function setT(int $t): self
    {
        $this->t = $t;

        return $this;
    }
}
