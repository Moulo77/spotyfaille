<?php

namespace App\Controller;

use App\Repository\MusiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(MusiqueRepository $musiqueRepository): Response
    {
        if($this->isGranted('ROLE_USER')==false){
            return $this->redirectToRoute('app_login');
        }

        $musiques = $musiqueRepository->findAll();

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'musiques'=>$musiques
        ]);
    }
}
