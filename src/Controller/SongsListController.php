<?php

namespace App\Controller;

use App\Entity\PlayedSongs;
use App\Entity\PlayedSongsSong;
use App\Entity\Song;
use App\Form\ListType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SongsListController extends Controller
{


    /**
     * @Route("/list", name="list")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        //TODO Check for user id
        $pList = $em->getRepository(PlayedSongs::class)->findAll();

        return $this->render('songs_list/index.html.twig', [
            'lists' => $pList
        ]);
    }


    /**
     * @Route("/list/create", name="list_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('login');
        }
        $list = new PlayedSongs();
        $list->setAddedAt(new \DateTime());
        $form = $this->createForm(ListType::class, $list);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        dump($request->request->get('songs'));
        dump($request->request->get('songTypes'));

        if ($form->isSubmitted() && $form->isValid()){
            $list = $form->getData();
            $list->setUser($this->getUser());


//            dd($list);



//            $i = 0;
//            foreach ($request->request->get('songs') as $songId){
//                $newRelation = new PlayedSongsSong;
//                $newRelation->setSong($em->getReference(Song::class, $songId));
//                $newRelation->setType($request->request->get('songTypes')[$i]);
//                $list->addPlayedSongsSong($newRelation);
//                $newRelation->setPlayedSongs($list);
//
//
//                $i++;
//                $em->persist($newRelation);
//            }
            $em->persist($list);
//            $em->flush();
            return $this->redirectToRoute('list');
        }

        $songs = $em->getRepository(Song::class)->findAll();

        return $this->render('songs_list/create.html.twig', [
            'form' => $form->createView(),
            'songs' => $songs,
            'types' => PlayedSongs::$types
        ]);
    }

}
