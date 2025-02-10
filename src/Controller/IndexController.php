<?php

namespace App\Controller;

use App\Entity\Cancion;
use App\Entity\Playlist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
final class IndexController extends AbstractController
{
  
    // ya que va a ser la pagina principal dejamos la ruta en /
    #[Route('/', name: 'app_home')]
    public function indexInicio(EntityManagerInterface $e): Response
    {
        $ultimasCanciones = $e->getRepository(Cancion::class)->findBy([], ['id' => 'DESC'], 6);
        $ultimasPlaylists = $e->getRepository(Playlist::class)->findBy([], ['id' => 'DESC'], 6);

        return $this->render('main/index.html.twig', [
            'ultimasCanciones' => $ultimasCanciones,
            'ultimasPlaylists' => $ultimasPlaylists,
        ]);
    }


}
