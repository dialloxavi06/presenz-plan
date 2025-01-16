<?php

namespace App\Controller;

use App\Entity\Planification;
use App\Entity\Employee;
use App\Form\PlanificationType;
use App\Repository\PlanificationRepository;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlanificationController extends AbstractController
{
    #[Route('/planification', name: 'app_planification')]
    public function index(PlanificationRepository $planificationRepository): Response
    {
        // Récupération de toutes les planifications
        $planifications = $planificationRepository->findAll();

        return $this->render('planification/index.html.twig', [
            'planifications' => $planifications,
        ]);
    }

    #[Route('/planification/create', name: 'planification_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $planification = new Planification();
        $form = $this->createForm(PlanificationType::class, $planification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planification);
            $entityManager->flush();

            $this->addFlash('success', 'Planification créée avec succès.');

            return $this->redirectToRoute('app_planification');
        }

        return $this->render('planification/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/planification/edit/{id}', name: 'app_planification_edit')]
    public function edit(
        Planification $planification,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(PlanificationType::class, $planification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Planification modifiée avec succès.');

            return $this->redirectToRoute('app_planification');
        }

        return $this->render('planification/edit.html.twig', [
            'form' => $form->createView(),
            'planification' => $planification,
        ]);
    }

    #[Route('/planification/delete/{id}', name: 'app_planification_delete')]
    public function delete(Planification $planification, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($planification);
        $entityManager->flush();

        $this->addFlash('success', 'Planification supprimée avec succès.');

        return $this->redirectToRoute('app_planification');
    }

    #[Route('/planification/{id}/employees', name: 'app_planification_employees')]
    public function employees(
        Planification $planification,
        EmployeeRepository $employeeRepository
    ): Response {
        // Récupérer les employés associés à une planification
        $employees = $employeeRepository->findBy(['planification' => $planification]);

        return $this->render('planification/employees.html.twig', [
            'planification' => $planification,
            'employees' => $employees,
        ]);
    }
}
