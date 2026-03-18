<?php

namespace App\Service;

use App\Entity\Libro;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.calcolatore_difficolta')]
Interface CalcolaDifficoltaInterface
{
    public function calcolaDifficolta( Libro $libro ): float|int;
}