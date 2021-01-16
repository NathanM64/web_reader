<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;


class UserFixtures extends Fixture
{
    const USER_COUNT = 40;

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i=0; $i < self::USER_COUNT; $i++) {
            $user = new User();
            $user->setFirstname($faker->name);
            $user->setLastname($faker->lastName);
            $user->setMail($faker->email);
            $user->setPassword($faker->password);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
