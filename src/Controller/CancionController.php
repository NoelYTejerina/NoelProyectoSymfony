<?php

namespace App\Controller;

use App\Entity\Estilo;
use App\Repository\EstiloRepository;
use App\Repository\CancionRepository;
use App\Entity\Cancion;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CancionController extends AbstractController
{
    #[Route('/canciones', name: 'app_canciones')]
    public function listarCanciones(EntityManagerInterface $em): Response
    {
        $canciones = $em->getRepository(Cancion::class)->findAll();

        return $this->render('cancion/index.html.twig', [
            'canciones' => $canciones,
        ]);
    }

    #[Route('/cancion/{id}', name: 'app_cancion_detalle')]
    public function verCancion(EntityManagerInterface $e, int $id): Response
    {
        $cancion = $e->getRepository(Cancion::class)->find($id);

        if (!$cancion) {
            throw $this->createNotFoundException('La canción no existe.');
        }

        return $this->render('cancion/detalle.html.twig', [
            'cancion' => $cancion,
        ]);
    }

    #[Route('/cancion/new_cancion', name: 'app_cancion_new')]
    public function newCancion(EntityManagerInterface $e): JsonResponse
    {
        $cancionRepository = $e->getRepository(Cancion::class);
        $estiloRepository = $e->getRepository(Estilo::class);
        $estilo = $estiloRepository->findOneByNombre('Heavy Metal');

        if (!$estilo) {
            return $this->json([
                'message' => 'El estilo Heavy Metal no existe en la base de datos.',
                'path' => 'src/Controller/CancionController'
            ]);
        }
        
        $cancion = new Cancion();
        $cancion->setTitulo('Rainbow in the dark');
        $cancion->setDuracion(255);
        $cancion->setAlbum('Holy Diver');
        $cancion->setAutor('Dio');
        $cancion->setFecha(1980);
        $cancion->setAlbumImagen('img/depecheV.jpg');
        $cancion->setGenero($estilo);
        
        $tituloCancion = $cancionRepository->findOneByTitulo($cancion->getTitulo());
        if(!$tituloCancion){
            $e->persist($cancion);
            $e->flush();
            
            return $this->json([
                'message' => 'Canción '.$cancion->getTitulo().' creada',
                'path' => 'src/Controller/CancionController'
            ]);
        } else {
            return $this->json([
                'message' => 'Canción '.$cancion->getTitulo().' ya existe en la base de datos',
                'path' => 'src/Controller/CancionController'
            ]);
        }
    }
}
