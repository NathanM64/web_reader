<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     * @param User|null $user
     * @return Response
     */
    public function details(User $user = null): Response
    {
        if($user && $user === $this->getUser()) {
            return $this->redirectToRoute('profile');
        }

        $user ??= $this->getUser();

        if( ! $user) {
            return $this->redirectToRoute('login');
        }

        return $this->render('user/details.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profile/update", name="profile_update")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function updateProfile(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();
        $profileForm = $this->createForm(ProfileFormType::class, $user);

        $profileForm->handleRequest($request);

        if($profileForm->isSubmitted() && $profileForm->isValid()) {
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('user/profile_form.html.twig', [
            'profile_form' => $profileForm->createView()
        ]);
    }
}
