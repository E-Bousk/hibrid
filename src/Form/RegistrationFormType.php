<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Email;

/**
 * Class RegistrationFormType | file RegistrationFormType.php
 *
 * This class is used to create form for the registration page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Associating the form with an entity
 * 
 */
class RegistrationFormType extends AbstractType
{
    /**
     * build the form : add label, constraints, placeholder etc...
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse email :',
                'attr' => [
                    'placeholder' => 'Adresse@Email.com'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une adresse email',
                    ]),
                    new Email([
                        'message' => "Votre adresse email n'est pas valide"
                    ])
                ]
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom :',
                'attr' => [
                    'placeholder' => 'Pierre'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un prénom',
                    ]),
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom :',
                'attr' => [
                    'placeholder' => 'Dupont'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nom',
                    ]),
                ]
            ])
            ->add('telephone2', IntegerType::class, [
                'label' => 'Téléphone mobile :',
                'required' => false,
                'attr' => [
                    'placeholder' => '06 00 01 02 03'
                ]
            ])
            ->add('telephone1', IntegerType::class, [
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
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly, this is read and encoded in the controller
                'label' => 'Mot de passe :',
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'mot de passe'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    /**
     * Associate the form with USER entity
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
