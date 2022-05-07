<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    // #[Route('/image', name: 'app_image')]
    // public function index(): Response
    // {
    //     return $this->render('image/index.html.twig', [
    //         'controller_name' => 'ImageController',
    //     ]);
    // }

    #[Route('/image/{id}', name: 'app_image_delete', methods: ['POST'])]
    public function delete(Request $request, Image $image, ImageRepository $imageRepository): Response
    {
        // if user is not connected, redirect to login page
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $trick = $image->getTrick();

        if ($this->isCsrfTokenValid('delete' . $image->getId(), $request->request->get('_token'))) {
            $fileSystem = new Filesystem();
            $directory = $this->getParameter('images_directory');
            $fileSystem->remove($directory . '/' . $image->getName());
            $imageRepository->remove($image);
        }

        $this->addFlash(
            'Success',
            'Image deleted!'
        );

        return $this->redirectToRoute('app_trick_edit', ["slug" => $trick->getSlug()], Response::HTTP_SEE_OTHER);
    }
}
