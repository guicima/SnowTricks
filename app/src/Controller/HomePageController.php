<?php

namespace App\Controller;

use App\Repository\TrickRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(TrickRepository $trickRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $tricksData = $trickRepository->findBy([], ['createdAt' => 'DESC']);

        $tricks = $paginator->paginate(
            $tricksData,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('home_page/index.html.twig', [
            'tricks' => $tricks,
        ]);
    }
}
