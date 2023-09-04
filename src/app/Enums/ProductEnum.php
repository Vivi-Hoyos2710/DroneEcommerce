<?php

declare(strict_types=1);

namespace App\Enums;

enum SizeType: string
{
    case small = 's';
    case medium = 'm';
    case large = 'l';
}
enum CategoryType: string
{
    case accessory = 'accessory';
    case base = 'base';
}
