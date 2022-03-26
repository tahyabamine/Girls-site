<?php

namespace App\Controller;

use App\Repository\CosmeticRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    // public function ajouter(): Response
    // {
    //     return $this->render('cosmetic/index.html.twig', [
    //         'controller_name' => 'CosmeticController',
    //     ]);
    // }
    // public function modifier(): Response
    // {
    //     return $this->render('cosmetic/index.html.twig', [
    //         'controller_name' => 'CosmeticController',
    //     ]);
    // }
}