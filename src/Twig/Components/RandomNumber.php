<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent]
final class RandomNumber
{
    use DefaultActionTrait;

    // #[LiveProp]
    #[LiveProp(writable: true)]
    public int $max = 1000;

    public function getRandomNumber(): int
    {
        return rand(0, $this->max);
    }
}
