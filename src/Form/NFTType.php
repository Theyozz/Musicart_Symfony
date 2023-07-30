<?php

namespace App\Form;

use App\Entity\NFT;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NFTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('img')
            ->add('description')
            ->add('launch_date')
            ->add('launch_price_eur')
            ->add('launch_price_eth')
            ->add('nFTCollection', EntityType::class, [ 
                'class' => 'App\Entity\NFTCollection', 
                'choice_label' => 'name', 
                'multiple' => false,
                'expanded' => false, 
            ])
            ->add('category', EntityType::class, [ 
                'class' => 'App\Entity\category', 
                'choice_label' => 'name', 
                'multiple' => true,
                'expanded' => true, 
            ])
            ->add('user', EntityType::class, [ 
                'class' => 'App\Entity\User', 
                'choice_label' => 'pseudo', 
                'multiple' => false,
                'expanded' => false, 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NFT::class,
        ]);
    }
}
