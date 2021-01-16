<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    const GENRE = [
        "Action",
        "Aventure",
        "Comédie",
        "Drame"
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::GENRE as $genreName) {
            $genre = new Genre();
            $genre->setName($genreName);
            $manager->persist($genre);
            $this->addReference('genre'.$i, $genre);
            $i++;
        }

        $manager->flush();
    }
}
