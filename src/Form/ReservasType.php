<?php

namespace App\Form;

use App\Entity\Reserva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReservasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fecha_inicio', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('dias_reservados', IntegerType::class)
            ->add('precio_total', IntegerType::class)
            ->add('creacion_reserva', DateType::class, [
                'widget' => 'choice',
            ])
            ->add('valoracion', IntegerType::class)
            ->add('comentario', TextType::class)
            ->add('barco_reserva', IntegerType::class)
            ->add('usuario_reserva', IntegerType::class)
            ->add('guardar', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
