<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Ssitdikov\Optimacros\Factory\ItemFactory;
use Ssitdikov\Optimacros\Formatter\ItemArrayFormatter;
use Ssitdikov\Optimacros\Object\Item;
use Ssitdikov\Optimacros\Object\TreeItem;
use Ssitdikov\Optimacros\Reader\CsvInputReader;
use Ssitdikov\Optimacros\Tree\JsonTreeBuilder;

#[CoversClass(ItemFactory::class)]
#[CoversClass(CsvInputReader::class)]
#[CoversClass(ItemArrayFormatter::class)]
#[CoversClass(Item::class)]
#[CoversClass(TreeItem::class)]
#[CoversClass(JsonTreeBuilder::class)]
class BasicTest extends TestCase
{
    public function test(): void
    {
        $reader = new CsvInputReader();
        $data = $reader->getDataFromFile(__DIR__ . '/../task/input.csv');
        $tree_builder = new JsonTreeBuilder();
        $result = $tree_builder->build($data);
        self::assertJsonStringEqualsJsonFile(
            __DIR__ . '/../task/output.json',
            json_encode($result, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR)
        );
    }

    public function testNotFound(): void
    {
        $reader = new CsvInputReader();
        $this->expectException(\Exception::class);
        $data = $reader->getDataFromFile(__DIR__ . '/input.json');
    }

}
