<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/user/comment')]
final class UserCommentController extends AbstractController
{
    // #[Route('', name: 'app_user_comment')]
    // public function index(): Response
    // {
    //     return $this->render('user_comment/index.html.twig', [
    //         'controller_name' => 'UserCommentController',
    //     ]);
    // }

    #[Route('/remove/{id}', name: 'user_remove_comment')]
    public function editComment(int $id, EntityManagerInterface $em, CommentRepository $commentRepository): Response
    {

        $comment = $commentRepository->find($id);

        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('home/one_recipe.html.twig');
    }
}
