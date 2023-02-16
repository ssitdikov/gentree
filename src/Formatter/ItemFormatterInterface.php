<?php

declare(strict_types=1);

namespace Ssitdikov\Optimacros\Formatter;

use Ssitdikov\Optimacros\Object\Enum\ItemTypeEnum;

interface ItemFormatterInterface
{

    public function __construct(array $fields);
    public function itemName(array $row): string;

    public function itemType(array $row): ItemTypeEnum;

    public function itemParent(array $row): ?string;

    public function itemRelation(array $row): ?string;

}
