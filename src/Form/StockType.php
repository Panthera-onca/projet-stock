<?php

namespace App\Form;

use App\Entity\Livre;
use App\Entity\Site;
use App\Entity\Stock;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('quantite_stock')
            ->add('date_modification')
            ->add('site', EntityType::class, [
                'class' => Site::class,
                'mapped' => false,
                'multiple' => true,
                'expanded' => true,
                'by_reference' =>false
            ])
            ->add('livre',EntityType::class, [
                'class' => Livre::class,
                'mapped' => false,
                'multiple' => true,
                'expanded' => true,
                'by_reference' =>false,


            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stock::class,
        ]);
    }
}
