<?php

namespace App\Controller\Admin;

use App\Entity\Playlist;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class PlaylistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Playlist::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nombre'),
            TextField::new('visibilidad'),
            IntegerField::new('reproducciones'),
            IntegerField::new('likes'),            
            AssociationField::new('propietario','Usuario')
            ->setFormTypeOptions([
                'by_reference' => false, 
            ]),
            AssociationField::new('reproduccionesDeUsuario', 'UsuarioPlaylist') 
            ->setFormTypeOptions([
                'by_reference' => false, 
            ]),
            AssociationField::new('canciones', 'Canciones') 
            ->setFormTypeOptions([
                'by_reference' => false, 
            ]),
    
        ];
    }
    
}
