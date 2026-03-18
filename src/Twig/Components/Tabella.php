<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Tabella
{
    public int $id;
    public string $nome;
    public string $cognome;
    public $data;
    public $disponibilita;
    public int $qualitaScrittura;
}
