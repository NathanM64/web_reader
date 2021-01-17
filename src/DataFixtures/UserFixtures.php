<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    const USER_COUNT = 40;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $password = $this->userPasswordEncoder->encodePassword(new User(), 'user');


        $faker = Faker\Factory::create('fr_FR');
        $user = new User();
        $user ->setFirstname("Nathan");
        $user ->setLastname("Marimbordes");
        $user ->setMail("marimbordes.nathan@gmail.com");
        $user->setPassword($this->userPasswordEncoder->encodePassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        for ($i=0; $i < self::USER_COUNT; $i++) {
            $user = new User();
            $user->setFirstname($faker->name);
            $user->setLastname($faker->lastName);
            $user->setMail($faker->email);
            $user->setPassword($password);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
