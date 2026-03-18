<?php

namespace App\Twig\Components;

use App\Repository\AutoreLibroRepository;
use App\Repository\AutoreRepository;
use App\Repository\LibroRepository;
use App\Service\CalcolaDifficoltaManager;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class CercaLibro
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    #[LiveProp]
    public $difficoltas;

    public function __construct( 
            private LibroRepository $libroRepository, 
            private AutoreLibroRepository $autoreLibroRepository, 
            private AutoreRepository $autoreRepository
        ){
    }

    public function getLibros(): array
    {
        // return della funzione find by query che c'è in AutoreRepository A CUI DARÒ IN PASTO $query
        return $this->libroRepository->findByQuery( $this->query );
    }

    public function getAutoreLibros(): array
    {
        return $this->autoreLibroRepository->findByQuery( $this->query);
    }
}
