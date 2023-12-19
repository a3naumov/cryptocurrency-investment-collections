<?php

namespace App\EventListener;

use App\Event\UserRegistrationEvent;
use App\Security\EmailVerifier;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: UserRegistrationEvent::NAME)]
final class UserRegistrationListener
{
    public function __construct(
        private EmailVerifier $emailVerifier,
    ) {
    }

    public function __invoke(UserRegistrationEvent $event): void
    {
        $this->emailVerifier->sendEmailConfirmation($event->getUser());

        return;
    }
}
