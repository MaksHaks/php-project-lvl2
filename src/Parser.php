<?php

namespace Differ\Parser;

use Exception;
use Symfony\Component\Yaml\Yaml;

function parse(string $content, string $type): array
{
    switch ($type) {
        case "json":
            return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
        case "yaml":
            return Yaml::parse($content);
        case "yml":
            return Yaml::parse($content);
        default:
            throw new Exception("Format {$type} not supported.");
    }
}
