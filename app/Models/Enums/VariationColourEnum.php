<?php

namespace App\Models\Enums;
use App\Traits\EnumToArray;

enum VariationColourEnum: string {
    use EnumToArray;

    case BLACK = 'BLACK';
    case WHITE = 'WHITE';
    case RED = 'RED';
    case BLUE = 'BLUE';
    case GREEN = 'GREEN';

}
