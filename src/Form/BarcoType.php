<?php

namespace App\Form;

use App\Entity\Barco;
use Doctrine\DBAL\Types\IntegerType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BarcoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('matricula' , TextType::class)
            ->add('pasajeros_maximos', IntegerType::class)
            ->add('precio_con_patron', IntegerType::class)
            ->add('precio_sin_patron', IntegerType::class)
            ->add('eslora' , IntegerType::class)
            ->add('calado' , IntegerType::class)
            ->add('caballos' , IntegerType::class)
            ->add('licencia', TextType::class)
            ->add('latitud', IntegerType::class)
            ->add('longitud', IntegerType::class)
            ->add('patron', CheckboxType::class, [
                'label'    => '¿Deseas un tener un patrón de barco?',
                'required' => false,
            ])
            ->add('imagenes', ImageField::class)
            ->add('guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Barco::class,
        ]);
    }
}
