<?php

namespace Php\Project\Lvl2\Formatters;

use Exception;

use function Php\Project\Lvl2\Formatters\Stylish\formatStylish;
use function Php\Project\Lvl2\Formatters\Plain\formatPlain;
use function Php\Project\Lvl2\Formatters\Json\formatJson;

//Функция, форматирующая полученные значения.

function render(array $diff, string $format)
{
    switch ($format) {
        case 'stylish':
            return formatStylish($diff);
            break;
        case 'plain':
            return formatPlain($diff);
            break;
        case 'json':
            return formatJson($diff);
            break;
        default:
            throw new Exception('There are no such format');
    }
}
