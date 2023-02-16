<?php

declare(strict_types=1);

namespace Ssitdikov\Optimacros\Formatter\Enum;

enum ItemFormatterFieldEnum: string
{
    case ITEM_NAME = 'Item Name';
    case TYPE = 'Type';
    case PARENT = 'Parent';
    case RELATION = 'Relation';
}
