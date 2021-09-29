<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

/**
 * Class ChangePasswordFormType | file ChangePasswordFormType.php
 *
 * This class is used to create form for the password-reset changing page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Using constraints to validate submition
 * Creating an option to decide to display 'current password' form or not
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
        if ($options['current_password_is_required']) {
            $builder
                ->add('currentPassword', PasswordType::class, [
                    'label' => 'Mot de passe courant:',
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'mot de passe courant'                    
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez indiquer votre mot de passe courant',
                        ]),
                        new UserPassword(['message' => 'Mot de passe courant invalide !'])
                    ],
                ])
            ;
        }

        $builder
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Nouveau mot de passe :',
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'nouveau mot de passe'                    
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
                        'placeholder' => 'nouveau mot de passe'
                    ],
                ],
                'invalid_message' => 'Les mots de passe ne sont pas identiques !',
            ])
        ;
    }

    /**
     * option to define if need to display 'current password' form on not
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'current_password_is_required' => false
        ]);
        
        $resolver->setAllowedTypes('current_password_is_required', 'bool');
    }
}
