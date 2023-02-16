<?php

namespace Ssitdikov\Optimacros\Reader;

use Ssitdikov\Optimacros\Factory\ItemFactory;
use Ssitdikov\Optimacros\Formatter\ItemArrayFormatter;
use Ssitdikov\Optimacros\Object\Item;

class CsvInputReader implements InputReaderInterface
{
    private ItemFactory $factory;

    public function __construct()
    {
        $this->factory = new ItemFactory();
    }

    /**
     * @param string $fileName
     * @param string $separator
     * @return Item[]
     */
    public function getDataFromFile(string $fileName, string $separator = ';'): array
    {
        $data = [];
        $fields = [];
        foreach ($this->getDataByRow($fileName, $separator) as $index => $row) {
            if ($index === 0) {
                $fields = $row;
                continue;
            }
            $data[] = $this->factory->create($row, new ItemArrayFormatter($fields));
        }
        return $data;
    }

    public function getDataByRow(string $fileName, string $separator): \Generator
    {
        if (file_exists($fileName)) {
            $handle = fopen($fileName, 'rb');
            if ($handle) {
                while ($line = fgetcsv($handle, separator: $separator)) {
                    yield $line;
                }
            }
        } else {
            throw new \Exception(
                sprintf('File "%s" is not found', $fileName)
            );
        }
    }
}
