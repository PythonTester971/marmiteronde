<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientCreationFormType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin/ingredient')]
final class AdminIngredientController extends AbstractController
{
    #[Route('/list', name: 'list_ingredient')]
    public function listIngredient(IngredientRepository $ingredientRepository): Response
    {
        $ingredients = $ingredientRepository->findAll();

        return $this->render('admin_ingredient/list_ingredient.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    #[Route('/item/{id}', name: 'item_ingredient')]
    public function itemIngredient(int $id, IngredientRepository $ingredientRepository): Response
    {
        $ingredient = $ingredientRepository->find($id);

        return $this->render('admin_ingredient/item_ingredient.html.twig', [
            'ingredient' => $ingredient,
        ]);
    }

    #[Route('/create', name: 'create_ingredient')]
    public function createIngredient(EntityManagerInterface $em, Request $request): Response
    {

        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientCreationFormType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($ingredient);
            $em->flush();
        }

        return $this->render('admin_ingredient/create_ingredient.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'edit_ingredient')]
    public function editIngredient(int $id, EntityManagerInterface $em, IngredientRepository $ingredientRepository, Request $request): Response
    {

        $ingredient = $ingredientRepository->find($id);

        $form = $this->createForm(IngredientCreationFormType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($ingredient);
            $em->flush();
        }

        return $this->render('admin_ingredient/edit_ingredient.html.twig', [
            'ingredient' => $ingredient,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/remove/{id}', name: 'remove_ingredient')]
    public function removeIngredient(int $id, EntityManagerInterface $em, IngredientRepository $ingredientRepository): Response
    {

        $ingredient = $ingredientRepository->find($id);

        $em->remove($ingredient);
        $em->flush();

        return $this->redirectToRoute('admin/index.html.twig');
    }
}
