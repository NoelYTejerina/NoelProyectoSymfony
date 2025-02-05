<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use App\Entity\Playlist;
use App\Entity\UsuarioPlaylist;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class UsuarioPlaylistCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UsuarioPlaylist::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('reproducida'),

            AssociationField::new('usuario', 'Usuario')
                ->setFormTypeOptions(['by_reference' => false]),

            AssociationField::new('playlist', 'Playlist')
                ->setFormTypeOptions(['by_reference' => false])

        ];
    }
}

