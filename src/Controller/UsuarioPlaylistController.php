<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Playlist;
use App\Entity\UsuarioPlaylist;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioPlaylistController extends AbstractController
{
    #[Route('/usuario/playlist', name: 'app_usuario_playlist')]
    public function index(): Response
    {
        return $this->render('usuario_playlist/index.html.twig', [
            'controller_name' => 'UsuarioPlaylistController',
        ]);
    }

    #[Route('usuario_playlist/new_usuario_playlist', name: 'app_usuario_playlist_new')]
    public function newPlaylistCancion(EntityManagerInterface $e): JsonResponse
    {

        $usuarioPlaylistRespository = $e->getRepository(UsuarioPlaylist::class);

        $playlist = $e->getRepository(Playlist::class)->findOneByNombre('Exitos del Rock');
        $usuario = $e-> getRepository(Usuario::class)->findOneByNombre('Noel');

        if(!$playlist && !$usuario){
            return $this->json([
                'message' => 'La Playlist o el usuario no existen',
                'path' => 'src/Controller/PlaylistCancionController'
            ]);
        }

        $usuarioPlaylist = new UsuarioPlaylist();
        $usuarioPlaylist->setPlaylist($playlist);
        $usuarioPlaylist->setUsuario($usuario);
        $usuarioPlaylist->setReproducida(0);

        $usuarioPlaylistExiste = $usuarioPlaylistRespository->findOneBy([
            'playlist' => $usuarioPlaylist->getPlaylist(),
            'usuario' => $usuarioPlaylist->getUsuario()
        ]);

        if(!$usuarioPlaylistExiste){
            $e->persist(($usuarioPlaylist));
            $e->flush();

            return $this->json([
                'message' => 'Relacion creada correctamente',
                'path' => 'src/Controller/PlaylistCancionController'
            ]);

        }else{
            return $this->json([
                'message' => 'Error al formar la relacion',
                'path' => 'src/Controller/PlaylistCancionController'
            ]);
        }

        

    }
}
