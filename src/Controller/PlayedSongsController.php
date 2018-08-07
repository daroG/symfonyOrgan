<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayedSongsController extends Controller
{
    /**
     * @Route("/played/songs", name="played_songs")
     */
    public function index()
    {
        return $this->render('played_songs/index.html.twig', [
            'controller_name' => 'PlayedSongsController',
        ]);
    }
}
