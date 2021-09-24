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
     * build the form : add label, placeholder etc...
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
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

    /**
     * Associate the form with RENTAL SPACE TYPE entity
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RentalSpaceType::class
        ]);
    }
}
