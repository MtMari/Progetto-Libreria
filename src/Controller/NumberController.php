<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// Suppose you want to create a page - /lucky/number - that generates a lucky (well, random) number
// and prints it. To do that, create a "Controller" class and a "number" method inside of it:
final class NumberController extends AbstractController
{
    #[Route('lucky/number', name: 'app_number')]
    public function number(): Response
    {
        $number = random_int(1, 20);

        return $this->render('number/index.html.twig', [
            'titolo' => 'lucky number',
            'number' => $number,
        ]);
    }
}
