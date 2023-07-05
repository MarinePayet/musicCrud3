<?php

namespace App\Controller;

use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlbumController extends AbstractController
{
    #[Route('/album', name: 'app_album')]
    public function index(): Response
    {
        return $this->render('album/index.html.twig', [
            'controller_name' => 'AlbumController',
        ]);
    }

    #[Route('/album/new', name: 'album_new')]
    public function new(Request $request, AlbumRepository $albumRepository): Response
    {
        $form = $this->createForm(AlbumType::class);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()){
            $album = $form->getData();
            $albumRepository->save($album, true);
            
            return $this->redirectToRoute('artists_index');
        }
        
        return $this->render('album/new.html.twig', [
            'albums' => $albumRepository->findAll(),
            'form' => $form,
        ]);
    }

}
