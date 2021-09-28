<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Class UserFormType | file UserFormType.php
 *
 * This class is used to create form for the modifying profile page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Associating the form with User entity
 * 
 */
class UserFormType extends AbstractType
{
    /**
     * build the form with labels 
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
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

    /**
     * Associate the form with USER entity
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
