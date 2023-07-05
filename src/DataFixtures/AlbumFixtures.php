<?php

namespace App\DataFixtures;

use App\Entity\Album;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AlbumFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $album = new Album();
        $album->setTitle('Trilogy');
        $album->setArtist($this->getReference(ArtistFixtures::ARTIST_THEWKD));
        $manager->persist($album);

        $album = new Album();
        $album->setTitle('After Hours');
        $album->setArtist($this->getReference(ArtistFixtures::ARTIST_THEWKD));
        $manager->persist($album);
        
        $album = new Album();
        $album->setTitle('FuturSex');
        $album->setArtist($this->getReference(ArtistFixtures::ARTIST_JTIM));
        $manager->persist($album);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArtistFixtures::class,
        ];  
    }
}
