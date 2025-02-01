<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\Playlist;
use App\Entity\PlaylistCancion;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistCancionController extends AbstractController
{
    #[Route('/playlist/cancion', name: 'app_playlist_cancion')]
    public function index(): Response
    {
        return $this->render('playlist_cancion/index.html.twig', [
            'controller_name' => 'PlaylistCancionController',
        ]);
    }

    #[Route('playlist_cancion/new_playlist_cancion', name: 'app_playlist_cancion_new')]
    public function newPlaylistCancion(EntityManagerInterface $e): JsonResponse
    {
        
        $playlistCancionRepository = $e->getRepository(PlaylistCancion::class);
        
        
        $playlist = $e->getRepository(Playlist::class)->findOneById(1); 
        $cancion = $e->getRepository(Cancion::class)->findOneById(1); 
        
        
        if (!$playlist || !$cancion) {
            return $this->json([
                'message' => 'La Playlist o la Canción no existen',
                'path' => 'src/Controller/PlaylistCancionController'
            ]);
        }
    
        
        $playlistCancion = new PlaylistCancion();
        $playlistCancion->setPlaylist($playlist); 
        $playlistCancion->setCancion($cancion);   
        
        // Comprobamos si ya existe la relación en la tabla intermedia
        $playlistCancionExistente = $playlistCancionRepository->findOneBy([
            'playlist' => $playlistCancion->getPlaylist(),
            'cancion' => $playlistCancion->getCancion()
        ]);
        
        
        if(!$playlistCancionExistente){
            $e->persist($playlistCancion);
            $e->flush();
            
            return $this->json([
                'message' => 'Relacion añadida correctamente',
                'path' => 'src/Controller/PlaylistCancionController'
            ]);
        } else {
            return $this->json([
                'message' => 'Esta canción ya está en la playlist',
                'path' => 'src/Controller/PlaylistCancionController'
            ]);
        }
    }
    
}
