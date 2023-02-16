<?php

declare(strict_types=1);

namespace Formatter;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Ssitdikov\Optimacros\Exception\InvalidItemTypeException;
use Ssitdikov\Optimacros\Formatter\Enum\ItemFormatterFieldEnum;
use Ssitdikov\Optimacros\Formatter\ItemArrayFormatter;
use Ssitdikov\Optimacros\Formatter\ItemFormatterInterface;
use Ssitdikov\Optimacros\Object\Enum\ItemTypeEnum;

#[CoversClass(ItemArrayFormatter::class)]
class ItemArrayFormatterTest extends TestCase
{

    private ItemFormatterInterface $formatter;
    private string $parent;
    private string $name;
    private array $row;

    public function setUp(): void
    {
        $fields = [
            ItemFormatterFieldEnum::PARENT->value,
            ItemFormatterFieldEnum::TYPE->value,
            ItemFormatterFieldEnum::RELATION->value,
            ItemFormatterFieldEnum::ITEM_NAME->value
        ];

        $this->parent = 'Родитель';
        $this->name = 'Наименование';

        $this->row = [
            $this->parent,
            ItemTypeEnum::PRODUCTS_AND_COMPONENTS->value,
            null,
            $this->name
        ];

        $this->formatter = new ItemArrayFormatter($fields);
    }

    /**
     * @test
     * @return void
     */
    public function itemParent(): void
    {
        self::assertEquals($this->parent, $this->formatter->itemParent($this->row));
    }

    /**
     * @test
     * @return void
     */
    public function itemName(): void
    {
        self::assertEquals($this->name, $this->formatter->itemName($this->row));
    }

    /**
     * @test
     * @return void
     */
    public function itemType(): void
    {
        self::assertEquals(ItemTypeEnum::PRODUCTS_AND_COMPONENTS, $this->formatter->itemType($this->row));
        $this->expectException(InvalidItemTypeException::class);
        $this->formatter->itemType(['', '', '', '']);
    }

    /**
     * @test
     * @return void
     */
    public function itemRelation(): void
    {
        self::assertNull($this->formatter->itemRelation($this->row));
    }

}
