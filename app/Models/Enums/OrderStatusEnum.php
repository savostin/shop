<?php

namespace App\Models\Enums;
use App\Traits\EnumToArray;

enum OrderStatusEnum: string {
    use EnumToArray;

    case UNPAID = 'UNPAID';
    case PAID = 'PAID';
    case ERROR = 'ERROR';
}
