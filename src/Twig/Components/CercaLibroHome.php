<?php

namespace App\Twig\Components;

use App\Repository\LibroRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class CercaLibroHome
{
    use DefaultActionTrait;

    #[LiveProp( writable:True )]
    public string $query = '';

    public function __construct( private LibroRepository $libroRepository ){

    }

    public function getLibros()
    {
        return $this->libroRepository->findByQueryHome( $this->query );
    }

}
