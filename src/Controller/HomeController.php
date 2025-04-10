<?php

namespace App\Controller;

use App\Entity\Recipe;
use DateTimeImmutable;
use App\Entity\Comment;
use App\Entity\Difficulty;
use App\Entity\Ingredient;
use PhpParser\Internal\DiffElem;
use App\Repository\RecipeRepository;
use App\Form\CommentCreationFormType;
use App\Repository\CategoryRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

final class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/creer-recette', name: 'temp_create_recette')]
    public function creerRecette(EntityManagerInterface $entityManager): Response
    {
        // On initialise une recette "vierge"
        $recette = new Recipe();

        // On passe par les "setters" pour remplir notre recette
        $recette->setTitle('Le nom de ma recette');
        $recette->setContent('lorem ipsum bidule');
        $recette->setNbPeople(6);
        $recette->setDuration(60);
        $recette->setCreatedAt(new DateTimeImmutable());
        $recette->setUpdatedAt(new DateTimeImmutable());

        // TODO
        $user = $this->getUser();
        $recette->setUser($user);

        $easy = new Difficulty();
        $easy->setLevel(1);
        $easy->setLabel("Facile");
        $easy->setCreatedAt(new DateTimeImmutable());
        $easy->setUpdatedAt(new DateTimeImmutable());

        $recette->setDifficulty($easy);
        // $recette->setUpdatedAt();

        // etc

        // Si besoin, on peut aussi créer d'autres objets

        $carotte = new Ingredient();
        $carotte->setLabel('TODO');

        $chocolat = new Ingredient();
        $chocolat->setLabel('TODO');


        // Et on les ajoute à notre recette
        $recette->addIngredient($carotte);
        $recette->addIngredient($chocolat);

        // N'hésitez pas à faire un petit dump pour voir si tout vous convient
        // Il faudra le retirer quand vous aurez fini
        dd($recette);

        // Une fois que votre recette est prête, il faut l'enregistrer en BDD
        $entityManager->persist($recette); // On se prépare à sauvegarder
        $entityManager->flush(); // On lance la sauvegarde

        // Maintenant vous pouvez aller vérifier en BDD si tout s'est bien passé
        // ou bien en utilisant votre RecetteRepository->findAll() par exemple

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/all-recipes', name: 'all_recipes')]
    public function recipes(RecipeRepository $recipeRepository): Response
    {
        $recipes = $recipeRepository->findAll();



        return $this->render('home/recipes.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/see-recipe/{id}', name: 'see_a_recipe')]
    public function recipeItem(int $id, RecipeRepository $recipeRepository, EntityManagerInterface $em, Request $request)
    {

        $recipe = $recipeRepository->find($id);
        $comments = $recipe->getComments();

        $comment = new Comment();
        $comment->setRecipe($recipe);
        $comment->setUser($this->getUser());
        $comment->setCreatedAt(new DateTimeImmutable());
        $comment->setUpdatedAt(new DateTimeImmutable());

        $form = $this->createForm(CommentCreationFormType::class, $comment);
        $form->handleRequest($request); //form ! écoute la request

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($comment);
            $em->flush();
        }

        return $this->render('home/one_recipe.html.twig', [
            'recipe' => $recipe,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }
}
