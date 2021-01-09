<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Stock;
use App\Entity\User;
use App\Form\LivreSearchType;
use App\Form\StockSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(): Response
    {
        return $this->render('search/index.html.twig', [
            'controller_name' => 'SearchController',
        ]);
    }

    /**
     * Matches /search_livres
     * @Route("/search_livres", name="app_searchLivre")
     * @param Request $request
     * @return Response
     */
    public function rechercheLivres(Request $request)
    {
        $em = $this->getDoctrine()->getManager();



        $form = $this->createForm(LivreSearchType::class);
        $form->handleRequest($request);

        $livre = $em->getRepository(Livre::class);

        if ($form->isSubmitted()) {

            $livre = $form->get('livres')->getData();
            $titre_livre = $form->get('titre_livre')->getData();
            $auteur = $form->get('auteur')->getData();


            return $this->redirectToRoute('app_resultat', [
                'livre' => $livre,
                'titre_livre' => $titre_livre,
                'auteur' => $auteur
            ]);

        }




        return $this->render('search/livre.html.twig', [
            'searchForm' => $form->createView(),

        ]);
    }

    /**
     * Matches /recherche
     * @Route("/recherche", name="app_recherche")
     * @param Request $request
     * @return Response
     */
    public function recherche(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(StockSearchType::class);
        $form->handleRequest($request);

        $stock = $em->getRepository(Stock::class);

        if ($form->isSubmitted()) {

            $stock = $form->get('stocks')->getData();
            $stock = $stock->getId();
            return $this->redirectToRoute('app_resultat', [
                'stock' => $stock,
            ]);

        }
        return $this->render('search/stock.html.twig', [
            'searchForm' => $form->createView(),

        ]);
    }

    /**
     * @Route("/resultat/{titre_livre}", name="app_resultat")
     * @param $livre
     * @return Response
     */
    public function resultat($livre)
    {
        $em = $this->getDoctrine()->getManager();

        $livre = $em->getRepository(Livre::class)->findBy(['livre'=>$livre]);


        return $this->render('search/resultat.html.twig', [
            'livres' => $livre,
        ]);
    }


}
