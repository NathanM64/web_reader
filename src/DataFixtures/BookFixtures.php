<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    const BOOK_COUNT = 60;
    const TYPE = [
        "Roman",
        "Manga",
        "Bande dessinée",
        "Manhwa"
    ];
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        //Generate 15 fake games
        for ($i=0; $i < self::BOOK_COUNT; $i++) {
            $book = new Book();
            $book->setTitle($faker->name);
            $book->setType(self::TYPE[random_int(0, count(self::TYPE)-1)]);
            $book->setDescription($faker->text(25));
            $book->setAuthor($faker->firstName.' '.$faker->lastName);
            $book->setRating(random_int(1.0, 5.0));

            for($j = 0; $j < random_int(0, 4); $j++) {
                $book->addGenre($this->getReference('genre'.random_int(0, count(GenreFixtures::GENRE) - 1)));
            }

            $this->addReference('book'.$i, $book);

            $manager->persist($book);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            GenreFixtures::class,
        ];
    }
}
