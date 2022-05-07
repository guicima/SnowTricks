<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('home_page/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }
}
