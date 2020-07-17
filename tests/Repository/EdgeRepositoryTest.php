<?php

namespace App\Tests\Repository;

use App\Entity\Edge;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EdgeRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testTransformAll()
    {
        $expectedEdges = [
            ['s' => 1, 't' => 2], ['s' => 1, 't' => 4], ['s' => 1, 't' => 5], ['s' => 1, 't' => 8],
            ['s' => 2, 't' => 5], ['s' => 2, 't' => 6],
            ['s' => 3, 't' => 6], ['s' => 3, 't' => 7], ['s' => 3, 't' => 10],
            ['s' => 5, 't' => 6],
            ['s' => 6, 't' => 9], ['s' => 6, 't' => 10],
            ['s' => 7, 't' => 10],
        ];

        $this->assertEquals($expectedEdges, $this->entityManager->getRepository(Edge::class)->transformAll());
    }
}
