<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
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
            TextField::new('Apellidos')
            ->setRequired(true),
            EmailField::new('Email')
            ->setRequired(true),
            TextField::new('Password')
            ->setFormType(PasswordType::class)
            ->setRequired(true),
            ChoiceField::new('Roles')
                ->setLabel("Rol")
                ->setChoices([ 
                        'USER' => 'ROLE_USER',
                        'ADMIN' => 'ROLE_ADMIN',
                        ])      
                        ->allowMultipleChoices(true)
                        ->renderExpanded()
                        ->setRequired(true),
            TextField::new('Tipo_Licencia')
            ->setRequired(true),
        ];
    }
}
