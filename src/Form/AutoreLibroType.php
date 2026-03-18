<?php

namespace App\Form;

use App\Entity\Autore;
use App\Entity\AutoreLibro;
use App\Repository\AutoreRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutoreLibroType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('autore', EntityType::class, [
                'class' => Autore::class,
                'choice_label' => 'nomeCognome',
                // 'query_builder' => fn(AutoreRepository $ar): QueryBuilder => $ar->findAllDisponibili(),
                'placeholder' => '-- Scegli un autore --',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AutoreLibro::class,
        ]);
    }
}
