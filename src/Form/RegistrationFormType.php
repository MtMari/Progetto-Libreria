<?php

namespace App\Form;

use App\Entity\Utente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, $options): void
    {
        $builder
            ->add('nomeUtente', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nome Utente',
                ],
                "trim" => true,
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'esempio@mail.com',
                ],
                "trim" => true,
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Password',
                ],
                'label' => false,
                "constraints" => [
                    new NotBlank(message: 'La password è obbligatoria'),
                    new Length(
                        min: 6,
                        minMessage: 'La password deve essere lunga almeno {{ limit }} caratteri',
                        max: 4096
                    )
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    "Base" => "ROLE_USER",
                    "Amministratore" => "ROLE_ADMIN"
                ],
                'label' => 'Permessi utente',
                'translation_domain' => false
            ])
        ;
        $builder->get('roles')
                ->addModelTransformer((new CallbackTransformer(
                    function ($rolesAsArray): string {
                        return count($rolesAsArray) ? $rolesAsArray[0] : null;
                    },
                    function ($rolesAsString): array {
                        return [$rolesAsString]; 
                    }
                )));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utente::class,
        ]);
    }
}
