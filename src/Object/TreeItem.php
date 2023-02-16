<?php

declare(strict_types=1);

namespace Ssitdikov\Optimacros\Object;

class TreeItem implements \JsonSerializable
{

    private string $itemName;
    private ?string $parent = null;
    private array $children = [];

    /**
     * @return string
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     * @param string $itemName
     * @return TreeItem
     */
    public function setItemName(string $itemName): TreeItem
    {
        $this->itemName = $itemName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getParent(): ?string
    {
        return $this->parent;
    }

    /**
     * @param string|null $parent
     * @return TreeItem
     */
    public function setParent(?string $parent): TreeItem
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return array
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @param array $children
     * @return TreeItem
     */
    public function setChildren(array $children): TreeItem
    {
        $this->children = $children;
        return $this;
    }


    public function jsonSerialize(): array
    {
        return [
            'itemName' => $this->getItemName(),
            'parent' => $this->getParent(),
            'children' => $this->getChildren()
        ];
    }

}
