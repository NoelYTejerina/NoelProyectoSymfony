<?php

namespace App\Controller;

use App\Entity\Estilo;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EstiloController extends AbstractController
{
    #[Route('/estilo', name: 'app_estilo')]
    public function index(): Response
    {
        return $this->render('estilo/index.html.twig', [
            'controller_name' => 'EstiloController',
        ]);
    }

    #[Route('estilo/new_estilo', name: 'app_estilo_new')]
    public function newEstilo(EntityManagerInterface $e): JsonResponse
    {
        $estiloRepository = $e->getRepository(Estilo::class);
        
        $estilo = new Estilo();
        $estilo->setNombre('Heavy Metal');
        $estilo->setDescripcion('El heavy metal es un género de rock caracterizado por guitarras distorsionadas, ritmos rápidos, voces poderosas y temas de rebeldía o oscuridad');
        
        $nombreEstilo = $estiloRepository->findOneByNombre($estilo->getNombre());
        if(!$nombreEstilo){
            $e->persist($estilo);
            $e->flush();
            
            return $this->json([
                'message' => 'Estilo '.$estilo->getNombre().' creado',
                'path' => 'src/Controller/EstiloController'
            ]);
        } else {
            return $this->json([
                'message' => 'Estilo '.$estilo->getNombre().' ya existe en la base de datos',
                'path' => 'src/Controller/EstiloController'
            ]);
        }
    }
}
