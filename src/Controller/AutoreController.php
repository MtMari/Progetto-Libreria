<?php

namespace App\Controller;

use App\Entity\Autore;
use App\Form\AutoreType;
use App\Repository\AutoreRepository;
use App\Security\Voter\AutoreVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/autore')]
final class AutoreController extends AbstractController
{
    #[Route(name: 'app_autore_index', methods: ['GET'])]
    public function index(AutoreRepository $autoreRepository): Response
    {
        return $this->render('autore/index.html.twig', [
            'autores' => $autoreRepository->findAllByNome(),
        ]);
    }

    #[Route('/new', name: 'app_autore_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $autore = new Autore();
        $form = $this->createForm(AutoreType::class, $autore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($autore);
            $entityManager->flush();

            return $this->redirectToRoute('app_autore_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('autore/new.html.twig', [
            'autore' => $autore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_autore_show', methods: ['GET'])]
    public function show(Autore $autore): Response
    {
        return $this->render('autore/show.html.twig', [
            'autore' => $autore,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_autore_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Autore $autore, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted(AutoreVoter::EDIT, $autore);
        $form = $this->createForm(AutoreType::class, $autore);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_autore_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('autore/edit.html.twig', [
            'autore' => $autore,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_autore_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Autore $autore, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autore->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($autore);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_autore_index', [], Response::HTTP_SEE_OTHER);
    }
}
