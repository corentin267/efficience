<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                'department' => 'rh',
                'mailResponsable' => 'gmonti@efficience.it'
            ],
            [
                'department' => 'direction',
                'mailResponsable' => 'arobert@efficience.it'
            ],
            [
                'department' => 'communication',
                'mailResponsable' => 'blefebvre@efficience.it'
            ],
            [
                'department' => 'développement',
                'mailResponsable' => 'alemoine@efficience.it'
            ]
        ];

        // Add Department fixture
        for ($i = 0; $i < sizeof($data); $i++) {
            $dep = new Department();
            $dep->setLabel($data[$i]['department']);
            $dep->setMailResponsable($data[$i]['mailResponsable']);
            $manager->persist($dep);
        }

        $manager->flush();
    }
}
