<?php

namespace App\Form;

use App\Entity\Barco;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class BarcoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('matricula' , TextType::class)
            ->add('pasajeros_maximos', NumberType::class)
            ->add('precio_con_patron', NumberType::class)
            ->add('precio_sin_patron', NumberType::class)
            ->add('eslora' , NumberType::class)
            ->add('calado' , NumberType::class)
            ->add('caballos' , NumberType::class)
            ->add('licencia', TextType::class)
            ->add('latitud', NumberType::class)
            ->add('longitud', NumberType::class)
            ->add('patron', CheckboxType::class, [
                'label'    => '¿Deseas un tener un patrón de barco?',
                'required' => false,
            ])
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
