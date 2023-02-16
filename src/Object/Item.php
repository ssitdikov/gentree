<?php

namespace Ssitdikov\Optimacros\Object;

use Ssitdikov\Optimacros\Object\Enum\ItemTypeEnum;

class Item
{
    private string $itemName;
    private ItemTypeEnum $type;
    private ?string $parent;
    private ?string $relation;

    /**
     * @param string $itemName
     * @param ItemTypeEnum $type
     * @param string|null $parent
     * @param string|null $relation
     */
    public function __construct(string $itemName, ItemTypeEnum $type, ?string $parent, ?string $relation)
    {
        $this->itemName = $itemName;
        $this->type = $type;
        $this->parent = $parent;
        $this->relation = $relation;
    }

    /**
     * @return string
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     * @return ItemTypeEnum
     */
    public function getType(): ItemTypeEnum
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getParent(): ?string
    {
        return $this->parent;
    }

    /**
     * @return string|null
     */
    public function getRelation(): ?string
    {
        return $this->relation;
    }
}
