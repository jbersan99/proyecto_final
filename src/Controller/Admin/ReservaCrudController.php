<?php

namespace App\Controller\Admin;

use App\Entity\Reserva;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class ReservaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reserva::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->renderContentMaximized();
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('ID')
            ->hideOnForm(),
            DateField::new('Fecha_Inicio')
            ->setRequired(true),
            DateField::new('Fecha_Fin')
            ->setRequired(true),
            NumberField::new('Precio_Total')
            ->setRequired(true),
            DateField::new('Creacion_Reserva')
            ->setRequired(true),
            TextField::new('Valoracion')
            ->setRequired(true),
            TextField::new('Comentario')
            ->setRequired(true),
        ];
    }
    
}
