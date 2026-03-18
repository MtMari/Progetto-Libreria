<?php

namespace App\EventListener;

use App\Event\DeleteLibroEvent;
use App\Service\CalcolaDifficoltaManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class DeleteLibroListener
{

    public function __construct(
        private readonly LoggerInterface $libroLogger,
        private readonly CalcolaDifficoltaManager $calcolaDifficoltaManager
    ){

    }

    #[AsEventListener(event: DeleteLibroEvent::class)]
    public function onDeleteLibroEvent(DeleteLibroEvent $event): void
    {
        $this->libroLogger->info('Libro eliminato correttamente', [
            // 'libroId' => $event->getLibro()->getId(),
            // 'titolo' => $event->getLibro()->getTitolo(),
            // 'pagine' => $event->getLibro()->getPagine(),
            // 'difficolta' => $this->calcolaDifficoltaManager->calcolaDifficoltaLibro($event->getLibro()),
            // 'descrizione' => $event->getLibro()->getDescrizione(),
        ]);    
    }
}
