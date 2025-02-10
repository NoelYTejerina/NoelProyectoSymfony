<?php

namespace App\Controller\Admin;

use App\Entity\Cancion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CancionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cancion::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titulo'),
            TextField::new('album'),
            TextField::new('autor'),
            IntegerField::new('duracion'),
            IntegerField::new('likes'),
            IntegerField::new('fecha'),
            IntegerField::new('reproducciones'),
            TextField::new('albumImagen'),
            TextField::new('archivo'),
            /*AssociationField::new('playlists', 'Playlists')
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),*/
            AssociationField::new('genero', 'Estilo')
                ->setFormTypeOptions([
                    'by_reference' => true,
                ]),
        ];
    }
}
