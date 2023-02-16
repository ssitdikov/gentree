<?php

declare(strict_types=1);

namespace Ssitdikov\Optimacros\Tree;

interface TreeBuilderInterface
{
    public function build(array $data): array;
}
