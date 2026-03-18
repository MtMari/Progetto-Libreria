<?php

namespace App\Event;

use App\Entity\Libro;
use Symfony\Contracts\EventDispatcher\Event;

class EditLibroEvent extends Event
{
    public function __construct( private Libro $libro ){
    }

    public function getLibro(): Libro
    {
        return $this->libro;
    }
}