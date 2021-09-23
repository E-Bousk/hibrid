<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

/**
 * Class RegistrationFormType | file RegistrationFormType.php
 *
 * This class is used to create form for the registration page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Associating the form with User entity
 * 
 */
class RegistrationFormType extends AbstractType
{
    /**
     * build the form : add label, password constraints, placeholder etc...
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email :',
                'attr' => [
                    'placeholder' => 'Adresse@Email.com'
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom :',
                'attr' => [
                    'placeholder' => 'Pierre'
                ],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom :',
                'attr' => [
                    'placeholder' => 'Dupont'
                ],
            ])
            ->add('telephone2', TelType::class, [
                'label' => 'Téléphone mobile :',
                'required' => false,
                'attr' => [
                    'placeholder' => '06 00 01 02 03'
                ]
            ])
            ->add('telephone1', TelType::class, [
                'label' => 'Téléphone fixe :',
                'required' => false,
                'attr' => [
                    'placeholder' => '01 02 03 04 05'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse postale :',
                'required' => false,
                'attr' => [
                    'placeholder' => '123 avenue du chemin 75000 Paris'
                ]
            ])
            // instead of being set onto the object directly, this is read and encoded in the controller
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe :',
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
            ])
        ;
    }

    /**
     * Associate the form with USER entity
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}
