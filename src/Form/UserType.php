<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo')
            // ->add('roles', ChoiceType::class, [
            //     'choices' => [
            //         'Role 1' => 'ROLE_USER', 
            //         'Role 2' => 'ROLE_ADMIN',
            //     ],
            //     'multiple' => true, 
            //     'expanded' => true, 
            //     'choice_label' => function ($choice, $key, $value) {
            //         return $value;
            //     },
            // ])
            ->add('password')
            ->add('email')
            ->add('gender')
            ->add('firstname')
            ->add('lastname')
            ->add('BirthDate')
            ->add('Address', AddressType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
