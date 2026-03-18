<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('test2')]
final class Test2
{
    public string $type = 'success';

    public string $message;
}
