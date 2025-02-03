<?php

namespace App\Controller;

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

        if(!$usuario){
            return $this->json([
                'message' => 'Usuario no encontrado, error al crear perfil',
                'path' => 'src/Controller/PerfilController'
            ],404);
        }
        
        if($usuario->getPerfil() !== null){
            return $this->json([
                'message' => 'Error, el usuario '.$nombreUsuario.' ya tiene perfil creado',
                'path' => 'src/Controller/PerfilController'
            ],400);
        }

        if(!$estilo){
            return $this->json([
                'message' => 'Error, estilo musical no encontrado o inexistente.
                 Si quieres registrar el nuevo estilo entra a ésta URL: 
                 http://localhost:8000/estilo/new_estilo/{nombreEstilo}/{descripcion}
                 sustituyendo los campos entre {} por su valor'
            ],404);
        }

        else{

            $perfil = new Perfil();
            $perfil->setDescripcion('Usuario Premium creador de listas variadas');
            $perfil->setFoto('../imagenes/img002.jpg');
            $perfil->setUsuario($usuario);
            $perfil->addEstilosPreferido($estilo);
            
            
            $e->persist($perfil);
            $e->flush();
            
            return $this->json([
                'message' => 'Perfil para el usuario'.$usuario->getNombre().' creado
                 Estilo favoritos añadidos :'.$estilo->getNombre(),
                'path' => 'src/Controller/PerfilController'
            ],200);
        }
         
    }

}
