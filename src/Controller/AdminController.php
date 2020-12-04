<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/admin", name="admin_")
 */

class AdminController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }



    /**
     * @Route("/admin", name="admin")
     */
    public function admin(){
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        if(!$this->isGranted("ROLE_ADMIN")){
            throw new AccessDeniedException("interdit aux simples utilisateurs");
        }
    }

    /**
     * @Route("/users", name="users")
     * @param UserRepository $users
     * @return Response
     */
    public function userList(UserRepository $users){
        return $this ->render("admin/users.html.twig", [
            'users' =>$users->findAll()
        ]);
    }

    /**
     * @Route("/", name="admin_home")
     */
    public function home(){
        return new Response("ok!");
    }

    /**
     * @Route("/test", name="admin_test")
     */
    public function test(){
        return new Response("ok!");
    }
}