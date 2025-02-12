<?php

namespace App\Controller\Admin;

use App\Entity\PlaylistCancion;
use App\Entity\Playlist;
use App\Entity\Cancion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlaylistCancionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlaylistCancion::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),            

            AssociationField::new('cancion', 'Cancion')
                ->setFormTypeOptions(['by_reference' => true]),

            AssociationField::new('playlist', 'Playlist')
                ->setFormTypeOptions(['by_reference' => true])->hideOnForm()

        ];
    }

    
}
