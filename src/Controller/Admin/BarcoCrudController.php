<?php

namespace App\Controller\Admin;

use App\Entity\Barco;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

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
            TextField::new('Nombre')
            ->setRequired(true),
            TextField::new('Matricula')
            ->setRequired(true),
            NumberField::new('Pasajeros_Maximos')
            ->setRequired(true),
            NumberField::new('Precio_Con_Patron')
            ->setRequired(true),
            NumberField::new('Precio_Sin_Patron')
            ->setRequired(true),
            NumberField::new('Eslora')
            ->setRequired(true),
            NumberField::new('Calado')
            ->setRequired(true),
            NumberField::new('Caballos')
            ->setRequired(true),
            TextField::new('Licencia')
            ->setRequired(true),
            NumberField::new('Latitud')
            ->setRequired(true),
            NumberField::new('Longitud')
            ->setRequired(true),
            ImageField::new('Imagenes')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(true),
            BooleanField::new('Patron')
            ->setRequired(false),
        ];
    }
    
}
