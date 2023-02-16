<?php

declare(strict_types=1);

namespace Ssitdikov\Optimacros\Tree;

use Ssitdikov\Optimacros\Object\Enum\ItemTypeEnum;
use Ssitdikov\Optimacros\Object\Item;
use Ssitdikov\Optimacros\Object\TreeItem;

class JsonTreeBuilder implements TreeBuilderInterface
{

    public function build(array $data): array
    {
        $tree = [];
        foreach ($data as $row) {
            /* @var Item $row */
            $tree[$row->getParent()][] = $row;
        }
        return $this->generate($tree);
    }

    /**
     * @param Item[] $data
     * @param string|null $parent
     * @return array
     */
    public function generate(array $data, ?string $parent = null): array
    {
        $tree = [];
        if (isset($data[$parent])) {
            foreach ($data[$parent] as $row) {
                $children = $this->getChildren($row, $data);
                $tree[] = (new TreeItem())
                    ->setItemName($row->getItemName())
                    ->setChildren($children)
                    ->setParent($row->getParent());
            }
        }
        return $tree;
    }

    public function getChildren(Item $item, array $data): array
    {
        $children = $this->generate($data, $this->getParentKey($item));
        if ($item->getType() === ItemTypeEnum::DIRECT_COMPONENTS) {
            foreach ($children as $one) {
                /* @var TreeItem $one */
                $one->setParent($item->getItemName());
            }
        }
        return $children;
    }

    /**
     * @param Item $item
     * @return string|null
     */
    public function getParentKey(Item $item): ?string
    {
        return $item->getType() === ItemTypeEnum::DIRECT_COMPONENTS ? $item->getRelation() : $item->getItemName();
    }
}
