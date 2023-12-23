<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Translation\TranslatableMessage;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', Type\EmailType::class, [
                'label' => new TranslatableMessage('Email Address'),
                'help' => new TranslatableMessage('Enter your email address.'),
                'attr' => [
                    'type' => 'email',
                    'placeholder' => new TranslatableMessage('Enter your email address...'),
                ],
                'required' => true,
                'mapped' => true,
            ])
            ->add('plainPassword', Type\PasswordType::class, [
                'label' => new TranslatableMessage('Password'),
                'help' => new TranslatableMessage('Enter your password.'),
                'attr' => [
                    'type' => 'password',
                    'placeholder' => new TranslatableMessage('Enter your password...'),
                ],
                'hash_property_path' => 'password',
                'required' => true,
                'mapped' => false,
            ])
            ->add('_remember_me', Type\CheckboxType::class, [
                'label' => new TranslatableMessage('Remember me'),
                'required' => false,
                'mapped' => false,
            ])
            ->add('submit', Type\SubmitType::class, [
                'label' => new TranslatableMessage('Sign in'),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'method' => Request::METHOD_POST,
            'csrf_token_id' => 'authenticate',
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
