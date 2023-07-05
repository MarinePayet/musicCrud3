<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public const ARTIST_THEWKD = 'ARTIST_THEWKD';
    public const ARTIST_JTIM = 'ARTIST_JTIM';


    public function load(ObjectManager $manager): void
    {
        $artist = new Artist();
        $artist->setName('The Weeknd');
        $manager->persist($artist);
        $this->addReference(self::ARTIST_THEWKD, $artist);
        
        $artist = new Artist();
        $artist->setName('Justin Timberlake');
        $manager->persist($artist);
        $this->addReference(self::ARTIST_JTIM, $artist);

        $manager->flush();
    }
}
