<?php

namespace App\Controller;

use App\Repository\ArtisteRepository;
use App\Repository\MusiqueRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
            'musiques'=>$musiques
        ]);
    }

    #[Route('/artiste/{artiste}',name: 'artiste')]
    public function artiste($artiste, MusiqueRepository $musiqueRepository,ArtisteRepository $artisteRepository): Response{
        $artister = $artisteRepository->findBy(array('nom'=>$artiste));
        $musiques = $musiqueRepository->findBy(array('artiste'=>$artister));

        return $this->render('index/artiste.html.twig',[
            'artiste'=>$artiste,
           'musiques'=>$musiques
        ]);
    }

    #[Route('/like/{id}', name: 'like')]
    public function like($id,MusiqueRepository $musiqueRepository, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $musique = $musiqueRepository->find($id);
        $user = $userRepository->findOneBy(array('email'=>$this->getUser()->getUserIdentifier()));

        $user->addLike($musique);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('homepage');
    }

    #[Route('/dislike/{id}', name: 'dislike')]
    public function dislike($id,MusiqueRepository $musiqueRepository, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $musique = $musiqueRepository->find($id);
        $user = $userRepository->findOneBy(array('email'=>$this->getUser()->getUserIdentifier()));

        $user->removeLike($musique);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('likes');
    }

    #[Route('/likes', name: 'likes')]
    public function likes(UserRepository $userRepository): Response
    {
        $user = $userRepository->findOneBy(array('email'=>$this->getUser()->getUserIdentifier()));

        $likes = $user->getLikes();

        return $this->render('index/likes.html.twig',[
           'likes'=>$likes
        ]);
    }
}
