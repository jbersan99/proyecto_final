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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


class BarcoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class ,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu nombre',
                    ])
                ],
            ])
            ->add('matricula' , TextType::class ,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu nombre',
                    ])
                ],
            ])
            ->add('pasajeros_maximos', IntegerType::class ,[
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'El maximo de pasajeros es {{ limit }}',
                        'max' => 20,
                    ]),
                ],
            ])
            ->add('precio_con_patron', IntegerType::class ,[
                'constraints' => [
                    new Length([
                        'min' => 400,
                        'minMessage' => 'El maximo de precio con patrón establecido es {{ limit }}',
                        'max' => 20000,
                    ]),
                ],
            ])
            ->add('precio_sin_patron', IntegerType::class ,[
                'constraints' => [
                    new Length([
                        'min' => 350,
                        'minMessage' => 'El maximo de precio sin patrón establecido es {{ limit }}',
                        'max' => 18000,
                    ]),
                ],
            ])
            ->add('eslora', IntegerType::class ,[
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'El maximo de eslora es {{ limit }}',
                        'max' => 20,
                    ]),
                ],
            ])
            ->add('calado', IntegerType::class ,[
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'El maximo de calado es {{ limit }}',
                        'max' => 20,
                    ]),
                ],
            ])
            ->add('caballos', IntegerType::class ,[
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'El maximo de caballos es {{ limit }}',
                        'max' => 20,
                    ]),
                ],
            ])
            ->add('licencia', TextType::class ,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor introduce tu nombre',
                    ])
                ],
            ])
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
