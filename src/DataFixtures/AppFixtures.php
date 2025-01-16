<?php

namespace App\DataFixtures;

use App\Entity\Departement;
use App\Entity\Employee;
use App\Entity\Jour;
use App\Entity\Planification;
use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'une Planification
        $planification = new Planification();
        $planification->setStartDatum(new \DateTime('2025-01-01'));
        $planification->setEndDate(new \DateTime('2025-12-31'));
        $manager->persist($planification);

        // Création d'employés
        $employee1 = new Employee();
        $employee1->setName('Mamadou Diallo')
                  ->setEmail('diallo@dfh-ufa.org')
                  ->setPhone('123456789')
                  ->setPlanification($planification);
        $manager->persist($employee1);

        $employee2 = new Employee();
        $employee2->setName('Véronique')
                  ->setEmail('véronique@dfh-ufa.org')
                  ->setPhone('987654321')
                  ->setPlanification($planification);
        $manager->persist($employee2);

        // Création de départements
        $departement1 = new Departement();
        $departement1->setName('IT')
                     ->setRef('R4')
                     ->setEmployee($employee1)
                     ->setPlanification($planification);
        $manager->persist($departement1);

        $departement2 = new Departement();
        $departement2->setName('HR')
                     ->setRef('R5')
                     ->setEmployee($employee2)
                     ->setPlanification($planification);
        $manager->persist($departement2);

        // Création de jours
        $jour1 = new Jour();
        $jour1->setJour('Lundi')
              ->setPlanification($planification);
        $manager->persist($jour1);

        $jour2 = new Jour();
        $jour2->setJour('Mardi')
              ->setPlanification($planification);
        $manager->persist($jour2);

        // Création de statuts
        $status1 = new Status();
        $status1->setStatut('DFH')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setPlanification($planification);
        $manager->persist($status1);

        $status2 = new Status();
        $status2->setStatut('HA')
                ->setCreatedAt(new \DateTimeImmutable())
                ->setPlanification($planification);
        $manager->persist($status2);

        // Envoi des données à la base
        $manager->flush();
    }
}
