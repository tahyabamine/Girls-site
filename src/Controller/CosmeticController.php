<?php

namespace App\Controller;

use App\Entity\Cosmetic;
use App\Form\CosmeticType;
use App\Repository\CosmeticRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CosmeticController extends AbstractController
{
    /**
     * @Route("/cosmetic", name="app_cosmetic")
     */
    public function liste(CosmeticRepository $repo): Response
    {
        $produits = $repo->findAll();
        return $this->render('cosmetic/index.html.twig', [
            'controller_name' => 'CosmeticController',
            'produits' => $produits
        ]);
    }
    /**
     * @Route("/cosmetic/create", name="create")
     */
    public function ajouter(CosmeticRepository $repo, Request $request): Response
    {
        $produit = new Cosmetic;

        $formulaire = $this->createForm(CosmeticType::class, $produit);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $repo->add($produit);
            return $this->redirectToRoute('app_cosmetic');
        } else {
            return $this->render('cosmetic/formulaire.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }
    /**
     * @Route("/cosmetic/{id}/update", name="update")
     */
    public function update($id, CosmeticRepository $repo, Request $request)
    {

        $produit = $repo->find($id);

        $formulaire = $this->createForm(CosmeticType::class, $produit);

        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $repo->add($produit);
            return $this->redirectToRoute('app_cosmetic');
        } else {
            return $this->render('cosmetic/formulaire.html.twig', [
                'formView' => $formulaire->createView(),
            ]);
        }
    }
    /**
     * @Route("/cosmetic/{id}/delete", name="delete")
     */
    public function supprimer($id, CosmeticRepository $repo): Response
    {
        $produit = $repo->find($id);
        $repo->remove($produit);

        return $this->redirectToRoute('app_cosmetic');
    }

    /**
     * @Route("/cosmetic{id}", name="details")
     */
    public function detail($id, CosmeticRepository $repo): Response
    {
        $produit = $repo->find($id);
        return $this->render('cosmetic/details.html.twig', [
            'produit' => $produit,
        ]);
    }

    public function modifier(): Response
    {
        return $this->render('cosmetic/index.html.twig', [
            'controller_name' => 'CosmeticController',
        ]);
    }
}