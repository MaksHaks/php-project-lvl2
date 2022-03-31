<?php

namespace Php\Project\Lvl2\Parser;

use Symfony\Component\Yaml\Yaml;

// Функция, принимающая на вход путь к файлу и возвращающая массив с его содержимым

function parse(string $path): array
{
    if (substr($path, -4) === "json") {
        $fileContent = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        return $fileContent;
    } else {
        $fileContent = Yaml::parseFile($path);
        return $fileContent;
    }
}
