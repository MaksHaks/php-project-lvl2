<?php

namespace Differ\Formatters;

use Exception;

use function Differ\Formatters\Stylish\render as stylishRender;
use function Differ\Formatters\Plain\render as plainRender;
use function Differ\Formatters\Json\render as jsonRender;

function render(array $diff, string $format)
{
    switch ($format) {
        case 'stylish':
            return stylishRender($diff);
        case 'plain':
            return plainRender($diff);
        case 'json':
            return jsonRender($diff);
        default:
            throw new Exception('There are no such format');
    }
}
