<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\Estilo;
use App\Repository\EstiloRepository;
use App\Repository\PerfilRepository;
use App\Entity\Usuario;
use App\Repository\UsuarioRepository;

use Doctrine\ORM\EntityManager;
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

    #[Route('perfil/new_perfil', name: 'app_perfil_new')]
    public function newPerfil(EntityManagerInterface $e): JsonResponse
    {
        $perfilRepository = $e->getRepository(Perfil::class);
        
        $perfil = new Perfil();
        $perfil->setDescripcion('Usuario Premium creador de listas variadas');
   
        
        
            $e->persist($perfil);
            $e->flush();
            
            return $this->json([
                'message' => 'Perfil '.$perfil->getId().' creado',
                'path' => 'src/Controller/PerfilController'
            ]);
         
    }

}
