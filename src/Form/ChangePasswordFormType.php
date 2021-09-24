<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ChangePasswordFormType | file ChangePasswordFormType.php
 *
 * This class is used to create form for the password-reset changing page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Using constraints to validate submition
 * Adding options if needed (associate with entity for exemple)
 */
class ChangePasswordFormType extends AbstractType
{
    /**
     * build the form : add label, constraints, placeholder etc...
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Nouveau mot de passe :',
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'mot de passe'                    
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir un mot de passe',
                        ]),
                        new Length([
                            'min' => 8,
                            'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe :',
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'mot de passe'
                    ],
                ],
                'invalid_message' => 'Les mots de passe ne sont pas identiques !',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
            ])
        ;
    }

    /**
     * No option needed here
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
