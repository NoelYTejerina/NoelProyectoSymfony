<?php

namespace App\Controller;  // Asegúrate de tener este espacio de nombres al inicio del archivo

use phpDocumentor\Reflection\DocBlock\Tags\Formatter\PassthroughFormatter;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Entity\Usuario;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistroController extends AbstractController 
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        $usuario = new Usuario();
        $form = $this->createForm(RegistrationFormType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hash the plain password
            $usuario->setPassword(
                $passwordHasher->hashPassword(
                    $usuario,
                    $form->get('password')->getData()
                )
            );
            // Asignar roles: Si no se selecciona ningún rol, se asigna 'ROLE_USER'
            $roles = $form->get('roles')->getData();
            if (empty($roles)) {
                $usuario->setRoles(['ROLE_USER']);  // Asignamos 'ROLE_USER' por defecto
            } else {
                $usuario->setRoles($roles);  // Si se seleccionan roles, usamos los proporcionados
            }
            $entityManager->persist($usuario);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #
}
