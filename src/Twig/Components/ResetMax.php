<?php

namespace App\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ResetMax extends AbstractController
{
    use DefaultActionTrait;



    #[LiveAction()]
    public function resetMax()
    {
        $this->max = 1000;

        $this->alert = 'Il max è stato resettato!';
        $this->addFlash('success', 'Il max è stato resettato!');

    }
}
