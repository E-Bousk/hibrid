<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Class LoginFormType | file LoginFormType.php
 *
 * This class is used to create form for the login page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Adding options if needed (associate with entity for exemple)
 * 
 */
class LoginFormType extends AbstractType
{
    /**
     * build the form : add label, placeholder etc...
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email :',
                'attr' => [
                    'placeholder' => 'Adresse email de connexion',
                    // 'novalidate' => 'novalidate'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe :',
                'attr' => [
                    'placeholder' => 'Votre mot de passe...'
                ]
            ]);
    }

    /**
     * No option needed here
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
