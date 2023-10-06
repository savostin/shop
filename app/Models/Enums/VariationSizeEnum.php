<?php

namespace App\Models\Enums;
use App\Traits\EnumToArray;

enum VariationSizeEnum: string {
    use EnumToArray;

    case SMALL = 'SMALL';
    case MEDIUM = 'MEDIUM';
    case BIG = 'BIG';

}
