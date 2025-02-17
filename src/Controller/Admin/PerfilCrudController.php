<?php

namespace App\Controller\Admin;

use App\Entity\Perfil;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class PerfilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Perfil::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('foto'),
            TextareaField::new('descripcion'),
            AssociationField::new('usuario','Usuario')
            ->setFormTypeOptions([
                'by_reference' => true, 
            ]),
           /* AssociationField::new('estilosPreferidos','PerfilEstilo')
            ->setFormTypeOptions([
                'by_reference' => false, 
            ]),*/
        ];
    }
    
}
