<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility', ChoiceType::class, [
                'choices' => [
                    'Monsieur' => 'Monsieur',
                    'Madame' => 'Madame',
                    'Mademoiselle' => 'Mademoiselle',
                ],
                'attr' => [
                    'autocomplete' => 'off',
                    'class' => 'form-control'
                ],
                'label' => 'Civilité',
                'placeholder' => '-- Choisir votre civilité --',
                'required' => true,
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'maxlength' => 60,
                    'autocomplete' => 'off',
                    'placeholder' => 'Nom',
                ],
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'maxlength' => 60,
                    'autocomplete' => 'off',
                    'placeholder' => 'Prénom(s)',
                ],
                'label' => 'Prénom(s)',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'maxlength' => 180,
                    'autocomplete' => 'off',
                    'placeholder' => 'Email',
                ],
                'label' => 'Email',
                'required' => true,
            ])
            ->add('mobilePhone', TelType::class, [
                'attr' => [
                    'maxlength' => 15,
                    'autocomplete' => 'off',
                    'placeholder' => 'Téléphone',
                ],
                'label' => 'Téléphone',
                'required' => true
            ])
            ->add('country', CountryType::class, [
                'attr' => [
                    'maxlength' => 60,
                    'autocomplete' => 'off',
                ],
                'label' => 'Country',
                'placeholder' => '-- Selectionnez votre pays --',
                'required' => true
            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre mot de passe, s\'il vous plait !',
                    ]),
                ],
                'type' => PasswordType::class,
                'invalid_message' => 'Le deux mots de passe ne sont pas identiques !',
                'options' => [
                    'attr' => [
                        'maxlength' => 255,
                        'autocomplete' => 'off',
                    ]
                ],
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Mot de passe',
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer le mot de passe'
                    ]
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter notre conditions.',
                    ]),
                ],
                'label' => 'J\'acceptes les conditions d\'utilisation.',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
