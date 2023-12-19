<?php

declare(strict_types=1);

namespace App\Enum\User;

enum Status: int
{
    case Active = 0;
    case Pending = 1;
    case Blocked = 2;
}
