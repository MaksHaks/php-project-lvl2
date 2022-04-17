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

function readFile(string $path)
{
    if (!file_exists($path)) {
        throw new Exception("Invalid file path: {$path}");
    }
    $fileContent = file_get_contents($path);
    if ($fileContent === false) {
        throw new Exception("Can't read file: {$path}");
    }
    return $fileContent;
}

function getExtension(string $path)
{
    return pathinfo($path, PATHINFO_EXTENSION);
}
