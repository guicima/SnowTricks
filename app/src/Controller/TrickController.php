<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Repository\CommentRepository;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

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
    public function new(Request $request, TrickRepository $trickRepository, TranslatorInterface $translator): Response
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

            $videoUrl = $form->get('video')->getData();

            if ($videoUrl != null) {
                $video = new \App\Entity\Image();
                $video->setName($videoUrl);
                $video->setType('video_url');
                $trick->addImage($video);
            }

            $trickRepository->add($trick);
            $this->addFlash(
                'success',
                $translator->trans('tricks.created')
            );
            return $this->redirectToRoute('app_home_page', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trick/new.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'app_trick_show', methods: ['GET', 'POST'])]
    public function show(Trick $trick, Request $request, CommentRepository $commentRepository, ValidatorInterface $validator, PaginatorInterface $paginator): Response
    {
        $commentsData = $commentRepository->findBy(['trickId' => $trick], ['createdAt' => 'DESC']);

        $comments = $paginator->paginate(
            $commentsData,
            $request->query->getInt('page', 1),
            10
        );

        if ($request->isMethod('POST')) {
            $comment = new Comment();
            $comment->setTrickId($trick);
            $comment->setUserId($this->getUser());
            $comment->setCreatedAt(new \DateTimeImmutable());
            $comment->setModifiedAt(new \DateTimeImmutable());
            $commentConstraint = new Assert\NotBlank();
            $commentConstraint->message = 'Comment cannot be empty';

            $data = $request->request->all();

            $errors = $validator->validate($data['text'], $commentConstraint);

            if (!$errors->count()) {
                $comment->setText($data['text']);
                $commentRepository->add($comment);
                return $this->redirectToRoute('app_trick_show', ['slug' => $trick->getSlug()], Response::HTTP_SEE_OTHER);
            } else {
                $this->addFlash(
                    'danger',
                    $errors->get(0)->getMessage()
                );
            }
        }


        return $this->render('trick/show.html.twig', [
            'trick' => $trick,
            'comments' => $comments,
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_trick_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trick $trick, TrickRepository $trickRepository, TranslatorInterface $translator): Response
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

            $videoUrl = $form->get('video')->getData();

            if ($videoUrl != null) {
                $video = new \App\Entity\Image();
                $video->setName($videoUrl);
                $video->setType('video_url');
                $trick->addImage($video);
            }

            $trickRepository->add($trick);
            $this->addFlash(
                'success',
                $translator->trans('tricks.updated')
            );
            return $this->redirectToRoute('app_home_page', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('trick/edit.html.twig', [
            'trick' => $trick,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}/delete', name: 'app_trick_delete', methods: ['POST'])]
    public function delete(Request $request, Trick $trick, TrickRepository $trickRepository, TranslatorInterface $translator): Response
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
                if ($image->getType() != 'video_url') {
                    $fileSystem->remove($directory . '/' . $image->getName());
                }
            }

            $trickRepository->remove($trick);
        }

        $this->addFlash(
            'success',
            $translator->trans('tricks.deleted')
        );

        return $this->redirectToRoute('app_home_page', [], Response::HTTP_SEE_OTHER);
    }
}
