<?php

namespace App\DataFixtures;

use App\Entity\Edge;
use App\Entity\Node;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Runner\Exception;

class GraphFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Set nodes v1, v2, ... ,v10

        for ($i = 1; $i <= 10; $i++) {
            $node = new Node();
            $node->setId($i);
            $node->setName('v' . $i);
            $manager->persist($node);
        }

        // Set edges

        $edgePairs = [
            [1, 2], [1, 4], [1, 5], [1, 8],
            [2, 5], [2, 6],
            [3, 6], [3, 7], [3, 10],
            [5, 6],
            [6, 9], [6, 10],
            [7, 10],
        ];

        foreach ($edgePairs as $pair) {
            if (count($pair) !== 2) {
                throw new Exception('An edge has been configured with a wrong number of ends!');
            }
            $edge = new Edge();
            $edge->setS($pair[0]);
            $edge->setT($pair[1]);
            $manager->persist($edge);
        }

        $manager->flush();
    }
}
