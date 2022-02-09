<?php

namespace App\Controller\Admin;

use App\Entity\Barco;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FileType;

class BarcoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Barco::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->renderContentMaximized();
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Nombre'),
            TextField::new('Matricula'),
            NumberField::new('Pasajeros_Maximos'),
            NumberField::new('Precio_Con_Patron'),
            NumberField::new('Precio_Sin_Patron'),
            NumberField::new('Eslora'),
            NumberField::new('Calado'),
            NumberField::new('Caballos'),
            TextField::new('Licencia'),
            NumberField::new('Latitud'),
            NumberField::new('Longitud'),
            BooleanField::new('Patron'),
            ImageField::new('Imagenes')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
        ];
    }
    
}
