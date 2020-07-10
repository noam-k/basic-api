<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class NodeController extends ApiController
{
    /**
     * @Route("/node")
     */
    public function nodeAction() {
        return new JsonResponse([
            'name' => 'e1'
        ]);
    }
}
