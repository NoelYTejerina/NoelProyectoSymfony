<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'app_usuario')]
    public function index(): Response
    {
        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'UsuarioController',
        ]);
    }

    #[Route('/usuario/new_usuario' , name: 'app_usuario_new')]
    public function new(EntityManagerInterface $e): JsonResponse
    {
        $usuarioRepository = $e->getRepository(Usuario::class);
  
        
        $usuario = new Usuario();
        $usuario->setEmail('pedroLozano@hotmail.com');
        $usuario->setPassword('Examen456');
        $usuario->setNombre('Pedro');
        $usuario->setFechaNacimiento(new \DateTime('1992-11-12'));
        
        $nombreUsuario = $usuarioRepository->findOneByNombre($usuario->getNombre());
        if(!$nombreUsuario){

            $e->persist($usuario);
            $e->flush();
            
            return $this->json([
                'message' => 'Usuario '.$usuario->getNombre().' creado',
                'path' => 'src/Controller/UsuarioController'
            ]);
        }else{
            return $this->json([
                'message' => 'Usuario '.$usuario->getNombre().' ya existe en la base de datos, imposible su creacion',
                'path' => 'src/Controller/UsuarioController'
            ]);
        }
    }
}
