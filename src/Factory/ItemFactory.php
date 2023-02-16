<?php

namespace Ssitdikov\Optimacros\Factory;

use Ssitdikov\Optimacros\Formatter\ItemFormatterInterface;
use Ssitdikov\Optimacros\Object\Item;

class ItemFactory
{
    public function create(array $itemData, ItemFormatterInterface $itemFormatter): Item
    {
        return new Item(
            $itemFormatter->itemName($itemData),
            $itemFormatter->itemType($itemData),
            $itemFormatter->itemParent($itemData),
            $itemFormatter->itemRelation($itemData)
        );
    }
}
