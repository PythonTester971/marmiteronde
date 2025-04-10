<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Difficulty;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeCreationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('media', TextType::class)
            ->add('content', TextType::class)
            ->add('duration', NumberType::class)
            ->add('cost', NumberType::class)
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('updatedAt', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('nbPeople', NumberType::class)

            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'label',
                'required'   => false,
                'multiple' => true,
                'expanded' => true,
            ])

            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => true,
            ])

            ->add('difficulty', EntityType::class, [
                'class' => Difficulty::class,
                'choice_label' => 'label',
            ])
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
