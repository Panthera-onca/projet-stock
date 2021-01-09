<?php


namespace App\Controller;



use App\Entity\Livre;
use App\Entity\Site;
use App\Entity\Stock;
use App\Entity\User;
use App\Form\LivreType;
use App\Form\StockType;
use App\Form\UserType;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_admin_dashboard")
     * @param LoggerInterface $logger
     * @return Response
     */
    public function dashboard(LoggerInterface $logger)
    {
        $logger->debug('Checking account page for '.$this->getUser()->getEmail());
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $nbrUser = $em->getRepository(User::class)->findAll();
        $nbrStock = $em->getRepository(Stock::class)->findAll();
        $nbrLivre = $em->getRepository(Livre::class)->findAll();

        $totalUser = count($nbrUser);
        $totalStock = count($nbrStock);
        $totalLivre = count($nbrLivre);


        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
            'totalUser' => $totalUser,
            'totalStock' => $totalStock,
            'totalLivre' => $totalLivre,
        ]);

    }

    /**
     * @Route("/dashboard/user", name="app_admin_dashboard_user")
     * @return Response
     */
    public function getAllUser()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findAll();


        return $this->render('admin/allUser.html.twig', [
            'users' => $users,

        ]);

    }

    /**
     * @Route("/dashboard/user/edit/{username}", name="app_admin_dashboard_user_edit")
     * @param Request $request
     * @param $username
     * @return Response
     */
    public function editOneUser(Request $request, $username)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneByUsernameOrEmail($username);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $livre = $form->get('livre')->getData();
            $stock = $form->get('stock')->getData();

            $user->setLivre($livre);
            $user->setStock($stock);
            //get Manager via Doctrine
            $em = $this->getDoctrine()->getManager();
            //keep info
            $em->persist($user);
            //save in DB
            $em->flush();

            //Message
            $this->addFlash('success', 'Modification réussie !');
            return $this->redirectToRoute('app_admin_dashboard_user');
        }

        return $this->render('admin/adminEditUser.html.twig', [
            'editForm' => $form->createView(),
            'user' => $user
        ]);


    }

    /**
     * @Route("/dashboard/livre/add", name="app_admin_dashboard_livre_add")
     * @param Request $request
     * @return Response
     */
    public function addLivre(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $livres = $em->getRepository(Livre::class)->findAll();

        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $livre = $form->getData();
            $livres = $form->get('livre')->getData();
            $livre->setName($livres);
            //get Manager via Doctrine
            $em = $this->getDoctrine()->getManager();
            //keep info
            $em->persist($livre);
            //save in DB
            $em->flush();


            // do anything else you need here, like send an email
            //Message
            $this->addFlash('success', 'Livre ajouté !');

            return $this->redirectToRoute('app_admin_dashboard_livre_add');

        }



        return $this->render('admin/AddLivre.html.twig', [
            'livres' => $livres,
            'LivreType' => $form->createView(),
        ]);

    }

    /**
     * @Route("/dashboard/stock/add", name="app_admin_dashboard_stock_add")
     * @param Request $request
     * @return Response
     */
    public function addStock(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $stocks = $em->getRepository(Stock::class)->findAll();

        $stock = new Stock();
        $form = $this->createForm(StockType::class, $stock);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $stock = $form->getData();
            $stocks = $form->get('stock')->getData();
            $stock->setName($stocks);
            //get Manager via Doctrine
            $em = $this->getDoctrine()->getManager();
            //keep info
            $em->persist($stock);
            //save in DB
            $em->flush();


            // do anything else you need here, like send an email
            //Message
            $this->addFlash('success', 'Stock ajouté !');

            return $this->redirectToRoute('app_admin_dashboard_stock_add');

        }



        return $this->render('admin/AddStock.html.twig', [
            'stocks' => $stocks,
            'StockType' => $form->createView(),
        ]);
    }

    /**
     * @Route("/dashboard/delete/admin/{id}",defaults={"id" = 0} ,name="app_admin_delete_confirm")
     * @return RedirectResponse
     * @param $id
     */
    public function adminDeleteUserConfirm($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usrRepo = $em->getRepository(User::class);

        $user = $usrRepo->find($id);
        $currentUserId = $this->getUser()->getId();

        //No need to invalidate session, no corruption since
        //user removed is not connected
        if ($currentUserId == $id)
        {
            $em->remove($user);
        }
        $em->flush();

        $this->addFlash('success', 'User désinscrit');
        return $this->redirectToRoute('app_admin_dashboard_user');
    }

    /**
     * @Route("/dashboard/stock/{id}", name="app_admin_stock_delete", methods={"DELETE"})
     */
    public function delete_stock(Request $request, Stock $stock): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stock->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stock);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stock_index');
    }

    /**
     * @Route("/dashboard/livre/{id}", name="app_admin_livre_delete", methods={"DELETE"})
     */
    public function delete_livre(Request $request, Livre $livre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_index');
    }

}