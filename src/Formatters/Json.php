<?php

namespace Differ\Formatters\Json;

function render(array $diff)
{
    return json_encode($diff, JSON_PRETTY_PRINT);
}
