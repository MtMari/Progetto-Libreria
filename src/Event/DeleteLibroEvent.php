<?php

namespace App\Event;

use App\Entity\Libro;
use Symfony\Contracts\EventDispatcher\Event;

class DeleteLibroEvent extends Event
{
    public function __construct( private Libro $libro ){

    }

    public function getLibro(): void
    {
        $this->libro;
    }
}