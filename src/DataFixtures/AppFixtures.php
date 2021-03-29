<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\MyGangers;
use App\Factory\UsersFactory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Créer plusieurs nouveaux users
		UsersFactory::new()->createMany(5);

		$manager->flush();
    }
}
