<?php

namespace Differ\Formatters\Plain;

function render(array $diff)
{
    $formattedString = makePlainFormat($diff);
    return trim($formattedString);
}

function makePlainFormat(array $diff, string $path = '')
{
    $formatedDiff = array_map(function ($element) use ($path) {

        if (!array_key_exists("Changed", $element)) {
            $key = $element['key'];
            $children = $element["children"];
            $value = ($children === []) ? normalizeValue($element["value"]) : '[complex value]';
            $type = $element["type"];

            if ($type === "Added") {
                $finalStirng = "Property '{$path}{$key}' was added with value: {$value}\n";
            } elseif ($type === "Deleted") {
                $finalStirng = "Property '{$path}{$key}' was removed\n";
            } else {
                $newPath = "{$path}{$key}.";
                $finalStirng = makePlainFormat($children, $newPath);
            }
        } else {
            $key = $element['Changed']['key'];
            $oldChildren = $element['Changed']['children'];
            $newChildren = $element['Added']['children'];
            $newValue = ($newChildren === []) ? normalizeValue($element['Added']['value']) : '[complex value]';
            $oldValue = ($oldChildren === []) ? normalizeValue($element['Changed']['value']) : '[complex value]';
            $finalStirng = "Property '{$path}{$key}' was updated. From {$oldValue} to {$newValue}\n";
        }
        return $finalStirng;
    }, $diff);
    return implode($formatedDiff);
}

function normalizeValue(mixed $value)
{
    if ($value === true) {
        return 'true';
    } elseif ($value === false) {
        return 'false';
    } elseif ($value === null) {
        return 'null';
    } elseif (is_numeric($value)) {
        return $value;
    } else {
        return "'{$value}'";
    };
}
