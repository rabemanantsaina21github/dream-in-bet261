<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/accueil", name="Accueil")
     * @Route("/accueil", name="app_home")
     */
    public function index(): Response
    {
        if (!$this->getUser()) {
            $this->addFlash('warning', "Vous n'avez pas le droit d'accès à cette page !");
            return $this->redirectToRoute('app_login');
        }

        return $this->render('home/accueil.html.twig');
    }

}
