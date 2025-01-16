<?php

namespace App\Form;

use App\Entity\Planification;
use App\Entity\Status;
use App\Entity\Jour;
use App\Entity\Employee;
use App\Entity\Departement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_datum', null, [
                'widget' => 'single_text',
            ])
            ->add('end_date', null, [
                'widget' => 'single_text',
            ])

            ->add('status', EntityType::class, [
                'class' => Status::class, 
                'choice_label' => 'statut', 
            ])
            
            ->add('employee', EntityType::class, [
                'class' => Employee::class, 
                'choice_label' => 'name', 
            ])
            
            ->add('departement', EntityType::class, [
                'class' => Departement::class, 
                'choice_label' => 'name', 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planification::class,
        ]);
    }
}
