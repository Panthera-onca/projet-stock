<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Filiere;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre_livre', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'titre-livre'
                ]
            ])
            ->add('auteur', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'auteur'
                ]
            ])
            ->add('filiere', EntityType::class, [
                'class' => Filiere::class,
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Filiere'
                ]
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Categorie'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'rechercher'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
}
