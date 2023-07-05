<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    #[Route('/artists', name: 'artists_index')]
    public function index(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();

        return $this->render('artist/index.html.twig', [
            'artists' => $artists,
        ]);
    }

    #[Route('/artists/{id<\d+>}', name: 'artist_show')]
    public function show(Artist $artist){

        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    // #[Route('/artists/{id<\d+>}', name: 'artist_new')]
    // public function new(Artist $artist){

    //     return $this->render('artist/new.html.twig', [
    //         'artist' => $artist,
    //     ]);
    // }

    #[Route('/artist/new', name: 'artist_new')]
    public function new(Request $request, ArtistRepository $artistRepository){
        
        $form = $this->createForm(ArtistType::class);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()){
            $artist = $form->getData();
            $artistRepository->save($artist, true);
            
            return $this->redirectToRoute('artists_index');
        }
        
        return $this->render('artist/new.html.twig', [
            'artists' => $artistRepository->findAll(),
            'form' => $form,
        ]);
    }


}
