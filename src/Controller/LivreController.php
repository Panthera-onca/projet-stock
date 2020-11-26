<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{

    /**
     * @Route("/livre", name="livre_list")
     */

    public function list(){
        $livreRepo = $this->getDoctrine()->getRepository(Livre::class);
        $livres = $livreRepo->findByExampleField();

        return $this->render('livre/list.html.twig', ["livres"=>$livres]);
    }

    /**
     * @Route("/livre/{nom_livre}", name="livre_detail", requirements={"nom_livre": "\w+"}, methods={"GET"})
     */
    public function detail($nom_livre, Request $request){
        $livreRepo = $this->getDoctrine()->getRepository(Livre::class);
        $livres = $livreRepo->find($nom_livre);
        if(empty($livre)){
            throw $this->createNotFoundException("Cette livre n'existe pas");
        }
        return $this->render('livre/detail.html.twig', ["livres"=>$livres]);
    }

    /**
     * @Route("/livre/add", name="livre_add")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function add(EntityManagerInterface $em, Request $request){

        $livre = new Livre();
        $livreForm = $this->createForm(LivreType::class, $livre);
        $livreForm->handleRequest($request);
        if ($livreForm->isSubmitted()){
            $em->persist($livre);
            $em->flush();

            $this->addFlash("success", "La livre était enregistrée!");
            return $this->redirectToRoute('livre_list');

        }

        return $this->render('livre/add.html.twig', ["livreForm"=>$livreForm->createView()]);


    }

    /**
     * @Route("/livre/delete/{id}", name="livre_delete", requirements={"id": "\d+"})
     */
    public function delete($id, EntityManagerInterface $em){
        $livreRepo = $this->getDoctrine()->getRepository(Livre::class);
        $livre = $livreRepo->find($id);

        $em->remove($livre);
        $em->flush();

        $this->addFlash('success', 'La livre était suprimmée!');

        return $this->redirectToRoute('home');

    }
}
