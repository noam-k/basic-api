<?php


namespace App\Controller;

use App\Entity\Node;
use App\Repository\NodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NodeController extends ApiController
{
    /**
     * @Route("/nodes", methods="GET")
     * @param NodeRepository $nodeRepository
     * @return JsonResponse
     */
    public function index(NodeRepository $nodeRepository): JsonResponse
    {
        $nodes = $nodeRepository->transformAll();
        return $this->respond($nodes);
    }

    /**
     * @Route("/nodes", methods="POST")
     * @param Request $request
     * @param NodeRepository $nodeRepository
     * @param EntityManagerInterface $entityManager
     * @return JsonResponse
     */
    public function create(Request $request, NodeRepository $nodeRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $request = $this->transformJsonBody($request);

        if (!$request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        if (!$request->get('name')) {
            return $this->respondValidationError('Please provide a node name!');
        }

        $node = new Node();
        $node->setName($request->get('name'));
        $entityManager->persist($node);
        $entityManager->flush();

        return $this->respondCreated($nodeRepository->transform($node));
    }
}
