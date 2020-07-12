<?php

namespace App\Tests\Controller;

use App\Controller\NodeController;
use App\Entity\Node;
use App\Repository\NodeRepository;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class NodeControllerTest extends TestCase
{

    public function testCreate()
    {
        $nodeRepository = $this->createMock(NodeRepository::class);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($nodeRepository);

        $request = new Request(['name' => 'w']); // todo: how does this work without setting an id?

        $this->assertEquals(
            new JsonResponse([],201),
            (new NodeController())->create($request, $nodeRepository, $entityManager)
        );
    }

    public function testIndex()
    {
        $nodeRepository = $this->createMock(NodeRepository::class);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($nodeRepository);

        $expectedResult = new JsonResponse([]); // todo: why does it not return existing nodes?

        $this->assertEquals($expectedResult, (new NodeController())->index($nodeRepository));
    }
}
