<?php

namespace App\Tests\Controller;

use App\Controller\NodeController;
use App\Entity\Edge;
use App\Repository\EdgeRepository;
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

    public function testCreateError()
    {
        $nodeRepository = $this->createMock(NodeRepository::class);

        $entityManager = $this->createMock(EntityManager::class);

        $this->assertEquals(
            new JsonResponse(['errors' => 'Please provide a node name!'], 422),
            (new NodeController())->create(new Request(), $nodeRepository, $entityManager)
        );
    }

    public function testIndex()
    {
        $transformedNodes = [
            [
                'id' => 1,
                'name' => 'v1',
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
        ];

        $nodeRepository = $this->createMock(NodeRepository::class);
        $nodeRepository->expects($this->any())
            ->method('transformAll')
            ->willReturn($transformedNodes);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($nodeRepository);

        $expectedResult = new JsonResponse($transformedNodes);

        $this->assertEquals($expectedResult, (new NodeController())->index($nodeRepository));
    }

    public function testGetNeighbors()
    {
        $edgeEntityT = [];
        $edgeEntityS = [];

        $edgesT = [2, 3, 5];
        $edgesS = [9, 10];

        foreach ($edgesT as $value) {
            $edgeEntityT[] = (new Edge())->setS(6)->setT($value);
        }

        foreach ($edgesS as $value) {
            $edgeEntityS[] = (new Edge())->setT(6)->setS($value);
        }

        $nodeRepository = $this->createMock(NodeRepository::class);

        $edgeRepositoryMock = $this->createMock(EdgeRepository::class);
        $edgeRepositoryMock->expects($this->exactly(2))
            ->method('findBy')
            ->willReturnOnConsecutiveCalls($edgeEntityT, $edgeEntityS);

        $entityManager = $this->createMock(EntityManager::class);
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($edgeRepositoryMock);

        $this->assertEquals(
            new JsonResponse([2, 3, 5, 9, 10]),
            (new NodeController())->getNeighbors(new Request(['id' => 6]), $nodeRepository, $entityManager)
        );
    }
}
