<?php

namespace App\DataFixtures;

use App\Entity\Morceaux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 50; $i++){
            $morceau = new Morceaux();
            $morceau->setNomMorceaux('Morceau #'. $i)
                    ->setDateSortie(new \DateTimeImmutable())
                    ->setArtiste('Artiste #', $i)
                    ->setGenreid(null);
            $manager->persist($morceau);
        }

    
    }
}
