<?php

declare(strict_types=1);

namespace App\Security;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class EmailVerifier
{
    public function __construct(
        private MailerInterface $mailer,
        private LoggerInterface $logger,
    ) {
    }

    public function sendEmailConfirmation(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('mailer@example.com', 'AcmeMailBot'))
            ->to($user->getEmail())
            ->subject('Please Confirm your email')
            ->htmlTemplate('email/registration/confirmation.html.twig')
            ->context([
                'user' => $user,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            $this->logger->critical('Email send error. User email: [{email}]. Details: [{details}].', [
                'email' => $user->getEmail(),
                'details' => $e->getMessage(),
            ]);
        }
    }
}
