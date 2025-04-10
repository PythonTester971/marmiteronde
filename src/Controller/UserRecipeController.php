<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeCreationFormType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user')]
final class UserRecipeController extends AbstractController
{
    #[Route('/recipes', name: 'recipes')]
    public function index(): Response
    {
        return $this->render('user_recipe/index.html.twig', [
            'controller_name' => 'UserRecipeController',
        ]);
    }

    #[Route('/create-recipes', name: 'user_create_recipes')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $recipe = new Recipe();
        $currentDateTime = new DateTimeImmutable();
        $recipe->setCreatedAt($currentDateTime);
        $recipe->setUpdatedAt($currentDateTime);
        $recipe->setUser($this->getUser());

        $form = $this->createForm(RecipeCreationFormType::class, $recipe);
        $form->handleRequest($request); //form ! écoute la request

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($recipe);
            $em->flush();
        }

        return $this->render('user_recipe/create_recipe.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
