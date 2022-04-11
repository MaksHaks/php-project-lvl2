<?php

namespace Php\Project\Lvl2\Formatters\Json;

function formatJson(array $diff)
{
    return json_encode($diff, JSON_PRETTY_PRINT);
}
