<?php

namespace Php\Project\Lvl2\Parser;

use Exception;
use Symfony\Component\Yaml\Yaml;

function parse(string $path): array
{
    $fileContent = readFile($path);
    $extension = getExtension($path);

    switch ($extension) {
        case "json":
            return json_decode($fileContent, true, 512, JSON_THROW_ON_ERROR);
        case "yaml":
            return Yaml::parse($fileContent);
        case "yml":
            return Yaml::parse($fileContent);
        default:
            throw new Exception("Format {$extension} not supported.");
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

function getExtension($path)
{
    return pathinfo($path, PATHINFO_EXTENSION);
}
