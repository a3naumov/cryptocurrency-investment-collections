<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;

class RegistrationFormType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => new TranslatableMessage('Email Address'),
                'help' => new TranslatableMessage('Enter your email address.'),
                'attr' => [
                    'type' => 'email',
                    'placeholder' => new TranslatableMessage('Enter your email address...'),
                ],
                'required' => true,
                'mapped' => true,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => new TranslatableMessage('Password'),
                    'help' => new TranslatableMessage('Choose a strong password for your account.'),
                    'attr' => [
                        'type' => 'password',
                        'placeholder' => new TranslatableMessage('Enter your password...'),
                    ],
                    'hash_property_path' => 'password',
                ],
                'second_options' => [
                    'label' => new TranslatableMessage('Confirm Password'),
                    'help' => new TranslatableMessage('Re-enter the password for confirmation.'),
                    'attr' => [
                        'type' => 'password',
                        'placeholder' => new TranslatableMessage('Confirm your password...'),
                    ],
                ],
                'required' => true,
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => new TranslatableMessage('Create an account'),
            ]);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'method' => Request::METHOD_POST,
        ]);
    }
}
