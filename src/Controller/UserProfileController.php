<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/user/profile')]
final class UserProfileController extends AbstractController
{
    #[Route('', name: 'app_user_profile')]
    public function accessUserProfile(): Response
    {

        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $user = $this->getUser(); // permet de récupérer le user connecté (côté PHP)
        //côté twig : app.user
        //$this : ici, correspond à l'application

        return $this->render('user_profile/info_perso.html.twig', [
            'user' => $user,
        ]);
    }
}
