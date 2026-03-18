<?php

namespace App\Twig\Components;

use App\Repository\AutoreRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class CercaAutore
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct( private AutoreRepository $autoreRepository ){
    }

    public function getAutores()
    {
        // return della funzione find by query che c'è in AutoreRepository A CUI DARÒ IN PASTO $query
        return $this->autoreRepository->findByQuery( $this->query );
    }
}
