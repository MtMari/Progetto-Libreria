<?php

namespace App\Service;

use App\Entity\Libro;
use App\Service\CalcolaDifficoltaInterface;

class PunteggioAutore implements CalcolaDifficoltaInterface
{
    public function calcolaDifficolta( Libro $libro ): float|int
    {
        $punteggioAutore = 0;

        foreach($libro->getAutores() as $autore){
            $punteggioAutore += $autore->getQualitaScrittura() * 2;
        }

        $punteggioTotale = $libro->getAutores()->count() > 1 ? $punteggioAutore / $libro->getAutores()->count() : $punteggioAutore;

        return $punteggioTotale;
    }
}