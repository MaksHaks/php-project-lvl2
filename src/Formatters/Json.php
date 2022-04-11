<?php

namespace Differ\Formatters\Json;

function formatJson(array $diff)
{
    return json_encode($diff, JSON_PRETTY_PRINT);
}
