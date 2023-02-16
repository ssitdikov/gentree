<?php

use Ssitdikov\Optimacros\Reader\CsvInputReader;
use Ssitdikov\Optimacros\Tree\JsonTreeBuilder;

require 'vendor/autoload.php';

$short = 'i:o:f::';
$long = [
    'input:',
    'output:',
    'format::'
];

$options = getopt($short, $long);
$reader = new CsvInputReader();
try {
    $items = $reader->getDataFromFile(__DIR__ . '/' . ($options['i'] ?? $options['input']));

    $tree_builder = new JsonTreeBuilder();
    $data = $tree_builder->build($items);

    file_put_contents(
        $options['o'] ?? $options['output'],
        json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR)
    );
} catch (\Exception $exception) {
    print $exception->getMessage();
}
