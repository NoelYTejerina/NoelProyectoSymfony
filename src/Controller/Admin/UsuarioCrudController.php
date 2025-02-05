<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Definir los campos del CRUD
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nombre'),
            TextField::new('email'),
            TextField::new('password')->hideOnForm(),
            //DateField::new('fechaNacimiento')->setFormat('yyyy-MM-dd'),

            
            AssociationField::new('perfil','Perfil')
                ->setFormTypeOptions(['by_reference' => false]),

            AssociationField::new('Playlists','Playlist')  
                ->setFormTypeOptions(['by_reference' => false]),
            
            AssociationField::new('playlistsReproducidas','UsuarioPlaylist') 
                ->setFormTypeOptions(['by_reference' => false])
                
        ];
    }

    
}

