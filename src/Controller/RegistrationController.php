<?php

namespace App\Controller;

use App\Entity\Utente;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registrazione', name: 'app_registrazione')]
    public function registrazione(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $utente = new Utente();

        $form = $this->createForm(RegistrationFormType::class, $utente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string $plainPassword */
            $plainPassword = $form->get('plainPassword')->getData();

            // encode the plain password
            $utente->setPassword($userPasswordHasher->hashPassword($utente, $plainPassword));

            $entityManager->persist($utente);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_libro_index');
        }

        return $this->render('registrazione/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
