<?php

declare(strict_types=1);

namespace App\Enums;

enum RolType: string
{
    case Admin = 'admin';
    case Customer = 'customer';
}
