<?php

namespace App\Controller;

use App\Entity\Libro;
use App\Event\DeleteLibroEvent;
use App\Event\EditLibroEvent;
use App\Event\NewLibroEvent;
use App\EventSubscriber\NewLibroSubscriber;
use App\Form\LibroType;
use App\Repository\AutoreLibroRepository;
use App\Repository\LibroRepository;
use App\Security\Voter\LibroVoter;
use App\Service\CalcolaDifficoltaManager;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Monolog\Attribute\WithMonologChannel;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/libro')]
#[WithMonologChannel('libro')]
// #[AutoconfigureTag('libro.controller')]
final class LibroController extends AbstractController
{
    #[Route(name: 'app_libro_index', methods: ['GET'])]
    public function index(AutoreLibroRepository $autoreLibroRepository, LibroRepository $libroRepository, CalcolaDifficoltaManager $calcolaDifficoltaManager, LoggerInterface $libroLogger, Request $request): Response
    {
        $libroLogger->info('Pagina {pagina} visitata', [
            'pagina' => $request->getPathInfo()
        ]);

        $libros = $libroRepository->findAllByTitle();
        $autoreLibros = $autoreLibroRepository->findAll();
        $difficoltaLibros = [];  
             
        foreach($libros as $libro)
        {
            $difficoltaLibros[$libro->getId()] = $calcolaDifficoltaManager->calcolaDifficoltaLibro($libro);
        }

        return $this->render('libro/index.html.twig', [
            'autoreLibros' => $autoreLibros, 
            'libros' => $libros,
            'difficoltas' => $difficoltaLibros
        ]);
    }

    #[Route('/new', name: 'app_libro_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager, LoggerInterface $libroLogger, EventDispatcherInterface $dispatcher ): Response
    {
        $libroLogger->info('Pagina {pagina} visitata', [
            'pagina' => $request->getPathInfo()
        ]);
        
        $libro = new Libro();
        
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($libro);
            $entityManager->flush();

            $event = new NewLibroEvent($libro);
            $dispatcher->dispatch($event, NewLibroEvent::class);

            return $this->redirectToRoute('app_libro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('libro/new.html.twig', [
            'libro' => $libro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_libro_show', methods: ['GET'])]
    public function show(EventDispatcherInterface $eventDispatcherInterface, Libro $libro, CalcolaDifficoltaManager $calcolaDifficoltaManager, LoggerInterface $libroLogger, Request $request): Response
    {
        $libroLogger->info('Pagina {pagina} visitata', [
            'pagina' => $request->getPathInfo(),
            'libroId' => $libro->getId(),
            'titolo' => $libro->getTitolo(),
        ]);

        $difficoltaLibro = $calcolaDifficoltaManager->calcolaDifficoltaLibro( $libro );
        $autoreLibro = $libro->getAutoreLibros()->getValues();

        return $this->render('libro/show.html.twig', [
            'libro' => $libro,
            'autoreLibro' => $autoreLibro,
            'difficolta' => $difficoltaLibro
        ]);
    }

    #[Route('/{id}/edit', name: 'app_libro_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Libro $libro, EntityManagerInterface $entityManager, LoggerInterface $libroLogger, EventDispatcherInterface $dispatcher ): Response
    {
        $this->denyAccessUnlessGranted(LibroVoter::EDIT, $libro);

        $libroLogger->info('Pagina {pagina} visitata', [
            'pagina' => $request->getPathInfo(),
            'libroId' => $libro->getId()
        ]);

        $autoreLibrosList = new ArrayCollection();

        foreach($libro->getAutoreLibros() as $autoreLibros){
            $autoreLibrosList->add($autoreLibros);
        }
        
        $form = $this->createForm(LibroType::class, $libro);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            foreach($autoreLibrosList as $autoreLibro){

                if($libro->getAutoreLibros()->contains($autoreLibro) === false){

                    $entityManager->remove($autoreLibro);
                }
            }

            try {
                
                if ($libro->getDescrizione() == "Descrizione"){
                    throw new Exception("Descrizione non valida");
                }
                
            } catch (Exception $e) {

                $libroLogger->error('descrizione non valida', [
                    'errore' => $e,
                    'libroId' => $libro->getId(),
                    'descrizione' => $libro->getDescrizione(),
                ]);
            }
            
            $entityManager->persist($libro);
            $entityManager->flush();

            $event= new EditLibroEvent( $libro );
            $dispatcher->dispatch($event, EditLibroEvent::class);

            return $this->redirectToRoute('app_libro_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->render('libro/edit.html.twig', [
            'libro' => $libro,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_libro_delete', methods: ['POST'])]
    #[IsGranted('ROLE_USER')]
    public function delete(Request $request, Libro $libro, EntityManagerInterface $entityManager, EventDispatcherInterface $dispatcher): Response
    {
        if ($this->isCsrfTokenValid('delete'.$libro->getId(), $request->getPayload()->getString('_token'))) {

            // $libroLogger->debug('Libro con ID {libroId} eliminato', [
            //     'libroId' => $libro->getId(),
            //     'titolo' => $libro->getTitolo(),
            //     'pagine' => $libro->getPagine(),
            //     'difficolta' => $calcolaDifficoltaManager->calcolaDifficoltaLibro($libro),
            //     'descrizione' => $libro->getDescrizione(),
            // ]);

            $event = new DeleteLibroEvent( $libro );
            $dispatcher->dispatch($event);
            
            $entityManager->remove($libro);
            $entityManager->flush();

        }

        return $this->redirectToRoute('app_libro_index', [], Response::HTTP_SEE_OTHER);
    }
}
