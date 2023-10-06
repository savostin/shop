<?php

namespace App\Models\Enums;
use App\Traits\EnumToArray;

enum ProductStatusEnum: string {
    use EnumToArray;

    case AVAILABLE = 'AVAILABLE';
    case HIDDEN = 'HIDDEN';

}
