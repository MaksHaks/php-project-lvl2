<?php

namespace Differ\Formatters;

use Exception;

use function Differ\Formatters\Stylish\formatStylish;
use function Differ\Formatters\Plain\formatPlain;
use function Differ\Formatters\Json\formatJson;

function render(array $diff, string $format)
{
    switch ($format) {
        case 'stylish':
            return formatStylish($diff);
        case 'plain':
            return formatPlain($diff);
        case 'json':
            return formatJson($diff);
        default:
            throw new Exception('There are no such format');
    }
}
