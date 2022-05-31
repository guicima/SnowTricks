<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function index(Request $request, ValidatorInterface $validator, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $imageConstraint = new Assert\Image();

        if ($request->isMethod('POST')) {
            $image = $request->files->get('image');

            $errors = $validator->validate($image, $imageConstraint);

            if (!$errors->count()) {
                $directory = $this->getParameter('images_directory');
                $userdata = $userRepository->find($user);

                if ($userdata->getImageUrl() != null) {
                    $fileSystem = new Filesystem();
                    $fileSystem->remove($directory . '/' . $userdata->getImageUrl());
                }

                $fileName = 'user_' . md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $directory,
                    $fileName
                );
                $userdata->setImageUrl($fileName);
                $userRepository->add($userdata);

                return $this->redirectToRoute('app_profile');
            } else {
                $this->addFlash(
                    'danger',
                    $errors->get(0)->getMessage()
                );
            }
        }


        return $this->render('profile/index.html.twig', [
            'user' => $user,
        ]);
    }
}
