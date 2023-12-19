<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

class UserRegistrationEvent extends Event
{
    public const NAME = 'app.user.registered';

    public function __construct(
        protected User $user,
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
