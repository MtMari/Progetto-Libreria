<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class HTMLsyntax
{
    public string $type = 'success';
    public string $message;
}
