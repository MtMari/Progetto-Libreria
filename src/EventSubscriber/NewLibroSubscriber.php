<?php

namespace App\EventSubscriber;

use App\Event\EditLibroEvent;
use App\Event\NewLibroEvent;
use App\Service\CalcolaDifficoltaManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NewLibroSubscriber implements EventSubscriberInterface
{
    public function __construct(
        
        private readonly LoggerInterface $libroLogger,
        private readonly CalcolaDifficoltaManager $calcolaDifficoltaManager )
    {
        
    }
    public function onNewLibroEvent(NewLibroEvent $event): void
    {
        $this->libroLogger->debug('Libro con ID {libroId} creato', [
            'libroId' => $event->getLibro()->getId(),
            'titolo' => $event->getLibro()->getTitolo(),
            'pagine' => $event->getLibro()->getPagine(),
            'difficolta' => $this->calcolaDifficoltaManager->calcolaDifficoltaLibro($event->getLibro()),
            'descrizione' => $event->getLibro()->getDescrizione(),
        ]);
    }

    public function onEditLibroEvent( EditLibroEvent $event ): void
    {
        $this->libroLogger->debug('Libro con ID {libroId} modificato', [
            'libroId' => $event->getLibro()->getId(),
            'titolo' => $event->getLibro()->getTitolo(),
            'pagine' => $event->getLibro()->getPagine(),
            'difficolta' => $this->calcolaDifficoltaManager->calcolaDifficoltaLibro($event->getLibro()),
            'descrizione' => $event->getLibro()->getDescrizione(),
        ]);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            NewLibroEvent::class => 'onNewLibroEvent',
            EditLibroEvent::class => 'onEditLibroEvent',
        ];
    }
}
