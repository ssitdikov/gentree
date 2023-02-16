<?php

declare(strict_types=1);

namespace Ssitdikov\Optimacros\Formatter;

use Ssitdikov\Optimacros\Exception\InvalidItemTypeException;
use Ssitdikov\Optimacros\Formatter\Enum\ItemFormatterFieldEnum;
use Ssitdikov\Optimacros\Object\Enum\ItemTypeEnum;

class ItemArrayFormatter implements ItemFormatterInterface
{
    private array $fieldIndexes;

    /**
     * @param array $fields
     */
    public function __construct(array $fields)
    {
        foreach ($fields as $index => $name) {
            $this->fieldIndexes[ItemFormatterFieldEnum::tryFrom($name)->value] = $index;
        }
    }


    public function itemName(array $row): string
    {
        return $row[$this->fieldIndexes[ItemFormatterFieldEnum::ITEM_NAME->value]];
    }

    public function itemType(array $row): ItemTypeEnum
    {
        $type = ItemTypeEnum::tryFrom($row[$this->fieldIndexes[ItemFormatterFieldEnum::TYPE->value]]);
        if (!$type) {
            throw new InvalidItemTypeException(
                sprintf(
                    'Некорректный тип - "%s"',
                    $row[1]
                )
            );
        }
        return $type;
    }

    public function itemParent(array $row): ?string
    {
        return $row[$this->fieldIndexes[ItemFormatterFieldEnum::PARENT->value]] ?: null;
    }

    public function itemRelation(array $row): ?string
    {
        return $row[$this->fieldIndexes[ItemFormatterFieldEnum::RELATION->value]] ?: null;
    }
}
