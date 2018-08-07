<?php

namespace App\Controller;

use App\Entity\Song;
use App\Entity\Tag;
use App\Form\SongType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SongController extends Controller
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index()
    {

        $songs = $this->getDoctrine()->getRepository(Song::class)->findAll();

        return $this->render('song/index.html.twig', [
            'user' => $this->getUser(),
            'songs' => $songs
        ]);
    }

    /**
     * @Route("/song", name="song_list")
     * @return Response
     */
    public function songList()
    {
        $songs = $this->getDoctrine()->getRepository(Song::class)->findAll();

        return $this->render('song/index.html.twig', [
            'user' => $this->getUser(),
            'songs' => $songs
        ]);
    }



    /**
     * @Route("/admin", name="admin")
     * @return Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function admin()
    {
        return new Response('<h1>Your truly an Admin!</h1>');
    }

    /**
     * @Route("/song/create", name="song_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $song = new Song;
        $form = $this->createForm(SongType::class, $song);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $song = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($song);

            $em->flush();

            return $this->redirectToRoute('song_list');
        }

        return $this->render('song/create.html.twig', [
            'form' => $form->createView(),
            'tags' => $this->getDoctrine()->getRepository(Tag::class)->findAll(),
        ]);
    }

    /**
     * @Route("/song/update/{id}", name="song_update")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function update($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(SongType::class, $em->getRepository(Song::class)->find(intval($id)));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $em->flush();
            return $this->redirectToRoute('song_list');
        }

        return $this->render('song/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/song/delete/{id}", name="song_delete")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete($id)
    {
        // TODO add security to that function. Check if user is logged and can delete Songs
        $em = $this->getDoctrine()->getManager();
        $song = $em->getRepository(Song::class)->find(intval($id));
        if(!$song){
            return $this->redirectToRoute('song_list');
        }

        $em->remove($song);
        $em->flush();

        $this->redirectToRoute('song_list');
    }
}
