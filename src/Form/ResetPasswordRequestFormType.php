<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class ResetPasswordRequestFormType | file ResetPasswordRequestFormType.php
 *
 * This class is used to create form for the password-reset request page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * using constraints to validate submition
 * Adding options if needed (associate with entity for exemple)
 */
class ResetPasswordRequestFormType extends AbstractType
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
            ->add('email', EmailType::class, [
                'label' => 'Adresse email :',
                'attr' => [
                    'placeholder' => 'Adresse@Email.com',
                    'autocomplete' => 'email'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez indiquer votre adresse email',
                    ]),
                    new Email([
                        'message' => "Cette adresse email n'est pas valide"
                    ])
                ],
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
