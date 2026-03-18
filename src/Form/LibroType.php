<?php

namespace App\Form;

use App\Entity\Libro;
use App\EventSubscriber\NewLibroSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LibroType extends AbstractType
{
    public function buildForm($builder, array $options): void
    {
        $builder
            ->add('titolo', TextType::class,[
                "trim" => true,
                "attr" => [
                    "placeholder" => "Inserisci titolo"
                ],
                'row_attr' => [
                    'class' => 'input-group'
                ],
                'translation_domain' => false
            ])
            ->add('autoreLibros', CollectionType::class,[
                'entry_type' => AutoreLibroType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false,
                'translation_domain' => false
            ])
            ->add('descrizione', TextareaType::class,[
                'label' => 'Descr.',
                'required' => false,
                'empty_data' => 'Descrizione non disponibile',
                'help' => 'La descrizione del libro',
                "attr" => [
                    "rows" => 7,
                    "cols" => 40,
                ],
                'translation_domain' => false
            ])
            ->add('pagine', IntegerType::class, [
                'translation_domain' => false,
                'attr' => [
                    'min' => '1', 
                    'placeholder' => 'Numero pagine',
                ],
                'row_attr' => [
                    'class' => 'input-group'
                ],
                'label' => 'Pagine'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
            'sanitize_html' => true,
        ]);
    }
}
