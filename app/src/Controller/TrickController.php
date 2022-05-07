<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[Route('/trick')]
class TrickController extends AbstractController
{
    #[Route('/', name: 'app_trick_index', methods: ['GET'])]
    public function index(TrickRepository $trickRepository): Response
    {
        return $this->render('trick/index.html.twig', [
            'tricks' => $trickRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_trick_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TrickRepository $trickRepository): Response
    {

        // if user is not connected, redirect to login page
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $trick = new Trick();
        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setCreatedAt(new \DateTimeImmutable());
            $trick->setModifiedAt(new \DateTimeImmutable());

            $imagesData = $form->get('images')->getData();

            foreach ($imagesData as $imageData) {
                $extension = $imageData->guessExtension();

                $fileName = md5(uniqid()) . '.' . $extension;
                $imageData->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                $image = new \App\Entity\Image();
                $image->setName($fileName);
                $image->setType($extension === 'mp4' ? 'video' : 'image');
                $trick->addImage($image);
            }

            $trickRepository->add($trick);

            $this->addFlash(
                'Success',
                'Trick created!'
            );
            return $this->redirectToRoute('app_home_page', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_trick_show', methods: ['GET'])]
    public function show(Trick $trick): Response
    {
        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_trick_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trick $trick, TrickRepository $trickRepository): Response
    {
        // if user is not connected, redirect to login page
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trick->setModifiedAt(new \DateTimeImmutable());

            $imagesData = $form->get('images')->getData();

            foreach ($imagesData as $imageData) {
                $extension = $imageData->guessExtension();
                $fileName = md5(uniqid()) . '.' . $extension;
                $imageData->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                $image = new \App\Entity\Image();
                $image->setName($fileName);
                $image->setType($extension === 'mp4' ? 'video' : 'image');
                $trick->addImage($image);
            }

            $trickRepository->add($trick);
            $this->addFlash(
                'Success',
                'Trick updated!'
            );
            return $this->redirectToRoute('app_home_page', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_trick_delete', methods: ['POST'])]
    public function delete(Request $request, Trick $trick, TrickRepository $trickRepository): Response
    {
        // if user is not connected, redirect to login page
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($this->isCsrfTokenValid('delete' . $trick->getId(), $request->request->get('_token'))) {
            $fileSystem = new Filesystem();
            $directory = $this->getParameter('images_directory');
            $images = $trick->getImages();
            foreach ($images as $image) {
                $fileSystem->remove($directory . '/' . $image->getName());
            }

            $trickRepository->remove($trick);
        }

        $this->addFlash(
            'Success',
            'Trick deleted!'
        );

        return $this->redirectToRoute('app_home_page', [], Response::HTTP_SEE_OTHER);
    }
}
