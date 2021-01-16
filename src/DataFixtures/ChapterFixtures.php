<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ChapterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        //Generate 15 fake games
        for ($i=0; $i < BookFixtures::BOOK_COUNT; $i++) {
            for ($j=0; $j < random_int(1, 5); $j++) {
                $chapter = new Chapter();
                $chapter->setNumber($j);
                $chapter->setTitle($faker->word);
                $chapter->setContent($faker->text(5000));
                $chapter->setDateAdd($faker->dateTimeBetween('-2 years', 'now'));
                $chapter->setBook($this->getReference('book'.$i));

                $manager->persist($chapter);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BookFixtures::class,
        ];
    }
}
