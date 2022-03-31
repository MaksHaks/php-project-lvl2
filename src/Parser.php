<?php

namespace Php\Project\Lvl2\Parser;

use Exception;
use Symfony\Component\Yaml\Yaml;

// Функция, принимающая на вход путь к файлу и возвращающая массив с его содержимым

function parse(string $path): array
{
    if (!file_exists($path)) {
        throw new Exception("File path error: {$path}");
    }

    $fileContent = file_get_contents($path);
    if ($fileContent === false) {
        throw new Exception("Can't read file: {$path}");
    }

    if (substr($path, -4) === "json") {
        $fileContent = json_decode(file_get_contents($path), true);
        return $fileContent;
    } else {
        $fileContent = Yaml::parseFile($path);
        return $fileContent;
    }
}
