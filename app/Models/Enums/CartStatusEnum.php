<?php

namespace App\Models\Enums;
use App\Traits\EnumToArray;

enum CartStatusEnum: string {
    use EnumToArray;

    case CREATED = 'CREATED';
    case PURCHASED = 'PURCHASED';
    case ERROR = 'ERROR';
}
