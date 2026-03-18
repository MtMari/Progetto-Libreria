<?php

namespace App\Service;

use App\Entity\Libro;
use App\Service\CalcolaDifficoltaInterface;

class PunteggioLibro implements CalcolaDifficoltaInterface
{
    public function calcolaDifficolta( Libro $libro ): float|int
    {
        $punteggioLibro = $libro->getPagine() / 10;

        return $punteggioLibro;
    }
}