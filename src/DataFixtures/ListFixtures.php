<?php

namespace App\DataFixtures;

use App\Entity\Mass;
use App\Entity\PlayedSongs;
use App\Entity\PlayedSongsSong;
use App\Entity\Song;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ListFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);



        $list = new PlayedSongs();
        $list->setMass($manager->getRepository(Mass::class)->find(1));
        $list->setUser($manager->getRepository(User::class)->find(1));
        $list->setAddedAt(new \DateTime());

        $pSong = new PlayedSongsSong(10, $list, $manager->getRepository(Song::class)->find(3));
//        $pSong->setType(10);
//        $pSong->setSong();
//        $pSong->setPlayedSongs($list);

        $manager->persist($list);
        $manager->persist($pSong);
        $manager->flush();
    }
}
