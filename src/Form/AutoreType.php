<?php

namespace App\Form;

use App\Entity\Autore;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomeAutore', TextType::class, [
                "trim" => true,
                'label' => 'Nome',
                'row_attr' => [
                    'class' => 'input-group'
                ],
                'translation_domain' => false
            ])
            ->add('cognomeAutore', TextType::class, [
                "trim" => true,
                'label' => 'Cognome',
                'row_attr' => [
                    'class' => 'input-group'
                ],
                'translation_domain' => false
            ])
            ->add('dataNascita', DateType::class,[
                'label' => 'Data di Nascita',
                'required' => false,
                'row_attr' => [
                    'class' => 'input-group'
                ],
                'translation_domain' => false
            ])
            ->add('disponibilita', CheckboxType::class, [
                'label' => 'Disponibilità Autore',
                'required' => false,
                'label_attr' => [
                    'class' => 'checkbox-switch'
                ],
                'row_attr' => [
                    'class' => 'input-group'
                ],
                'translation_domain' => false,
            ])
            ->add('qualitaScrittura', IntegerType::class, [
                'translation_domain' => false,
                'attr' => [
                    'min' => '1', 
                    'max' => '5',
                ],
                'row_attr' => [
                    'class' => 'input-group'
                ],
                'label' => 'Punteggio',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Autore::class,
            'sanitize_html' => true,
        ]);
    }
}
