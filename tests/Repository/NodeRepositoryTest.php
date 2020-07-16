<?php

namespace App\Tests\Repository;

use App\Entity\Node;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class NodeRepositoryTest extends KernelTestCase
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
        $expectedNodes = [
            [
                'id' => 1,
                'name' => 'v1',
            ],
            [
                'id' => 10,
                'name' => 'v10',
            ],
            [
                'id' => 2,
                'name' => 'v2',
            ],
            [
                'id' => 3,
                'name' => 'v3',
            ],
            [
                'id' => 4,
                'name' => 'v4',
            ],
            [
                'id' => 5,
                'name' => 'v5',
            ],
            [
                'id' => 6,
                'name' => 'v6',
            ],
            [
                'id' => 7,
                'name' => 'v7',
            ],
            [
                'id' => 8,
                'name' => 'v8',
            ],
            [
                'id' => 9,
                'name' => 'v9',
            ],
        ];

        $this->assertSame($expectedNodes, $this->entityManager->getRepository(Node::class)->transformAll());
    }
}
