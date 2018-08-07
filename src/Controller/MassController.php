<?php

namespace App\Controller;

use App\Entity\Mass;
use App\Form\MassType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MassController extends Controller
{
    /**
     * @Route("/mass", name="mass")
     */
    public function index()
    {
        $masses = $this->getDoctrine()->getRepository(Mass::class)->findAll();

        return $this->render('mass/index.html.twig', compact('masses'));
    }


    /**
     * @Route("/mass/create", name="mass_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $mass = new Mass;
        $form = $this->createForm(MassType::class, $mass);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $mass = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($mass);
            $em->flush();

            return $this->redirectToRoute('mass');
        }

        return $this->render('mass/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/mass/update/{id}", name="mass_update")
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(MassType::class, $em->getRepository(Mass::class)->find(intval($id)));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirectToRoute("mass");
        }

        return $this->render("mass/update.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
