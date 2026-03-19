<?php

namespace App\Controller;

use App\Repository\LibroRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function homepage( LibroRepository $libroRepository ): Response
    {
        // ottieni i dati di tutti i libri -> fai lo shuffle con slice nel tpl
        $libri = $libroRepository->findAllByTitle();

        return $this->render('home/index.html.twig', [
            'libri' => $libri,
        ]);
    }
}
