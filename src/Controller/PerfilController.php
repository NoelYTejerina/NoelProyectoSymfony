<?php

namespace App\Controller;

use App\Entity\PerfilEstilo;
use App\Entity\Perfil;
use App\Entity\Estilo;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PerfilController extends AbstractController
{
    #[Route('/perfil', name: 'app_perfil')]
    public function index(): Response
    {
        return $this->render('perfil/index.html.twig', [
            'controller_name' => 'PerfilController',
        ]);
    }

    #[Route('perfil/new_perfil/{nombreUsuario}/{estiloFavorito}', name: 'app_perfil_new')]
    public function newPerfil(EntityManagerInterface $e, string $nombreUsuario, string $estiloFavorito): JsonResponse
    {
        $usuarioRepository = $e->getRepository(Usuario::class);
        $estiloRepository = $e->getRepository(Estilo::class);

        $estilo = $estiloRepository->findOneByNombre($estiloFavorito);
        $usuario = $usuarioRepository->findOneByNombre($nombreUsuario);



        if (!$usuario) {
            return $this->json([
                'message' => 'Usuario no encontrado, error al crear perfil',
                'path' => 'src/Controller/PerfilController'
            ], 404);
        }

        if ($usuario->getPerfil() !== null) {
            return $this->json([
                'message' => 'Error, el usuario ' . $nombreUsuario . ' ya tiene perfil creado',
                'path' => 'src/Controller/PerfilController'
            ], 400);
        }

        if (!$estilo) {
            return $this->json([
                'message' => 'Error, estilo musical no encontrado o inexistente.
                 Si quieres registrar el nuevo estilo entra a ésta URL: 
                 http://localhost:8000/estilo/new_estilo/{nombreEstilo}/{descripcion}
                 sustituyendo los campos entre {} por su valor'
            ], 404);
        } else {
            // creacion del perfil
            $perfil = new Perfil();
            $perfil->setDescripcion('Usuario Premium creador de listas variadas');
            $perfil->setFoto('../imagenes/img002.jpg');
            $perfil->setUsuario($usuario);

            // creacion de la relacion en la tabla intermedia
            $perfilEstilo = new PerfilEstilo();
            $perfilEstilo->setPerfil($perfil);
            $perfilEstilo->setEstilo($estilo);

            $perfil->addEstilosPreferidos($perfilEstilo);

            $e->persist($perfil);
            $e->persist($perfilEstilo);
            $e->flush();

            return $this->json([
                'message' => 'Perfil para el usuario ' . $usuario->getNombre() . ' creado. Estilos favorito añadido: ' . $estiloFavorito,
                'path' => 'src/Controller/PerfilController'
            ], 200);
        }
    }

    #[Route('perfil/añadir_estilo/{nombreUsuario}/{estiloFavorito}', name: 'app_perfil_add_estilo')]
    public function addEstilo(EntityManagerInterface $e, string $nombreUsuario, string $estiloFavorito): JsonResponse
    {
        $usuarioRepository = $e->getRepository(Usuario::class);
        $estiloRepository = $e->getRepository(Estilo::class);

        $estilo = $estiloRepository->findOneByNombre($estiloFavorito);
        $usuario = $usuarioRepository->findOneByNombre($nombreUsuario);

        // validaciones
        if (!$usuario) {
            return $this->json([
                'message' => 'Usuario no encontrado, error al añadir estilos favoritos al perfil',
                'path' => 'src/Controller/PerfilController'
            ], 404);
        }

        if (!$estilo) {
            return $this->json([
                'message' => 'Estilo no encontrado, error al añadir estilo favorito al perfil',
                'path' => 'src/Controller/PerfilController'
            ], 404);
        }

        $perfil = $usuario->getPerfil();
        if (!$perfil) {
            return $this->json([
                'message' => 'Error, el usuario ' . $nombreUsuario . ' no tiene perfil creado',
                'path' => 'src/Controller/PerfilController'
            ], 400);
        }
        // comprueba si el estilo ya esta en los favoritos del perfil
        $existeEstiloEnPerfil = false;
        $estilosDelPerfil = $perfil->getEstilosPreferidos();
        foreach ($estilosDelPerfil as $perfilEstilo) {
            if ($perfilEstilo->getEstilo() === $estilo) {
                $existeEstiloEnPerfil = true;
                break;
            }
        }

        if ($existeEstiloEnPerfil) {
            return $this->json([
                'message' => 'El estilo ' . $estiloFavorito . ' ya está en los estilos favoritos de ' . $nombreUsuario
            ], 400);
        } else {
            $perfilEstilo = new PerfilEstilo();
            $perfilEstilo->setPerfil($perfil);
            $perfilEstilo->setEstilo($estilo);

            $perfil->addEstilosPreferidos($perfilEstilo);

            $e->persist($perfilEstilo);
            $e->flush();

            return $this->json([
                'message' => 'Estilo ' . $estiloFavorito . ' añadido a los estilos preferidos del usuario ' . $nombreUsuario
            ], 200);
        }
    }
}
