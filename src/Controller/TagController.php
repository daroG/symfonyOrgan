<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Form\TagType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TagController extends Controller
{
    /**
     * @Route("/tag", name="tag")
     */
    public function index()
    {
        return $this->render('tag/index.html.twig', [
            'tags' => $this->getDoctrine()->getRepository(Tag::class)->findAll(),
        ]);
    }

    /**
     * @Route("/tag/create", name="tag_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tag = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->redirectToRoute('tag');
        }

        return $this->render('tag/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/api/tag/create", name="api_tag_create", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function apiCreate(Request $request)
    {
        $tag = new Tag();
        $title = $request->request->get('title');
        if($title && !empty($title) && $title !== null){
            $tag->setTitle($title);

            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();

            return $this->json([
                'type' => 'ok',
                'message' => 'New tag created',
                'id' => $tag->getId(),
                'title' => $tag->getTitle()
            ]);
        }
        return $this->json(['type' => 'error', 'error' => 'No title defined']);
    }
}
