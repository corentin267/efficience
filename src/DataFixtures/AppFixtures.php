<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

/**
 * Class AppFixtures
 * @package App\DataFixtures
 */
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');

        // Add Department fixture
        for ($i = 0; $i < 4; $i++) {
            $dep = new Department();
            $dep->setLabel($faker->company);
            $dep->setMailResponsable($faker->companyEmail);
            $manager->persist($dep);
        }

        $manager->flush();
    }
}
