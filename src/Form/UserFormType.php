<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom :',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom :',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email :',
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse postale :',
                'required' => false,
            ])
            ->add('telephone1', TelType::class, [
                'label' => 'Téléphone mobile :',
                'required' => false,
            ])
            ->add('telephone2', TelType::class, [
                'label' => 'Téléphone fixe :',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
