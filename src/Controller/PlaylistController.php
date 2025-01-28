<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Playlist;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlaylistController extends AbstractController
{
    #[Route('/playlist', name: 'app_playlist')]
    public function index(): Response
    {
        return $this->render('playlist/index.html.twig', [
            'controller_name' => 'PlaylistController',
        ]);
    }

    #[Route('playlist/new_playlist', name: 'app_playlist_new')]
    public function newPlaylist(EntityManagerInterface $e): JsonResponse
    {
        $playlistRepository = $e->getRepository(Playlist::class);
        $usuarioRepositorio = $e->getRepository(Usuario::class);
        $propietario = $usuarioRepositorio->findOneByNombre('Noel');
        
        if(!$propietario){
            return $this->json([
                'message' => 'Error al asignar propietario',
                'path' => 'src/Controller/UsuarioController'
            ]);
        }
        $playlist = new Playlist();
        $playlist->setNombre('Exitos del Rock');
        $playlist->setVisibilidad('Publica');
        $playlist->setPropietario($propietario);
        $playlist->setReproducciones(0); // inicializada con valor 0
        $playlist->setLikes(0);


        $nombrePlaylist = $playlistRepository->findOneByNombre($playlist->getNombre());

        if ($propietario && $propietario !== null && !$nombrePlaylist) {
            $e->persist($playlist);
            $e->flush();

            return $this->json([
                'message' => 'Playlist ' . $playlist->getNombre() . ' creada',
                'path' => 'src/Controller/PlaylistController'
            ]);
        } else {
            return $this->json([
                'message' => 'Playlist ' . $playlist->getNombre() . ' ya existe en la base de datos',
                'path' => 'src/Controller/PlaylistController'
            ]);
        }
    }
}
