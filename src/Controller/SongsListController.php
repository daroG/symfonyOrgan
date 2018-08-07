<?php

namespace App\Controller;

use App\Entity\Mass;
use App\Entity\PlayedSongs;
use App\Entity\PlayedSongsSong;
use App\Entity\Song;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SongsListController extends Controller
{

    public $types = [
        10 => ['Wejście', 'W'],
        12 => ['Przygotowanie darów', 'Pd'],
        14 => ['Komunia 1', 'K1'],
        15 => ['Komunia 2', 'K2'],
        18 => ['Uwielbienie', 'U'],
        20 => ['Zakończenie', 'Z'],
    ];

    /**
     * @Route("/list", name="list")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        //TODO Check for user id
        $pList = $em->getRepository(PlayedSongs::class)->findAll();

        $sPs = [];

        foreach ($pList as $l){
            $sPs[] = [
                'id' => $l->getId(),
                'songs' => array_map(function ($e){
                    return [$e->getType(), $e->getSong()];
                }, $em->getRepository(PlayedSongsSong::class)->findBy(['PlayedSongs' => $l->getId()])),
                'mass' => $l->getMass(),
                'author' => $l->getUser(),
                'added_at' => $l->getAddedAt()
            ];
        }

//        dd($sPs);

        return $this->render('songs_list/index.html.twig', [
            'controller_name' => 'SongsListController',
            'lists' => $sPs
        ]);
    }


}
