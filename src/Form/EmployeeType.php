<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Prénom et Nom',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Saisir le Nom et Prénom de l\'employé',
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Address',
                'attr' => [
                    'class' => 'form-control',
                'placeholder' => 'Saisir l\'addresse mail',
                ],
            ])
            ->add('phone', TextType::class, [
                'label' => 'Numéro de DW ou Téléphone',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Saisir le Numéro de DW',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
