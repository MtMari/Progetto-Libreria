<?php

namespace App\Service;

use App\Entity\Libro;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class CalcolaDifficoltaManager
{
    public function __construct( 
        #[AutowireIterator('app.calcolatore_difficolta')]
        private iterable $calcolatori
    ) {
    }

    public function calcolaDifficoltaLibro( Libro $libro ): string
    {
        $difficoltaLibro = 0;

        foreach($this->calcolatori as $calcolatore)
        {
            $difficoltaLibro += $calcolatore->calcolaDifficolta( $libro );
        }
        
        return match( true ){
            $difficoltaLibro >= 45 => 'Difficile',
            $difficoltaLibro <= 30 => 'Facile',
            $difficoltaLibro < 45 => 'Media'
        };
    }
}