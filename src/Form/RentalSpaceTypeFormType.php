<?php

namespace App\Form;

use App\Entity\RentalSpaceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class RentalSpaceTypeFormType | file RentalSpaceTypeFormType.php
 *
 * This class is used to create form for the rental space management page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Associating the form with RentalSpaceType entity
 * 
 */
class RentalSpaceTypeFormType extends AbstractType
{
    /**
     * build the form : add label, constraints, placeholder etc...
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation', TextType::class, [
                'label' => "Type d'espace locatif :",
                'attr' => [
                    'placeholder' => "Renseigner ici le type d'espace locatif",
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentalSpaceType::class
        ]);
    }
}
