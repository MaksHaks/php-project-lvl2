<?php

namespace Differ\Formatters\Plain;

function formatPlain(array $diff)
{
    $formattedString = makePlainFormat($diff);
    return trim($formattedString);
}

function makePlainFormat(array $diff, string $path = '')
{
    $formatedDiff = array_map(function ($element) use ($path) {

        if (!array_key_exists("Changed", $element)) {
            $key = array_key_first($element);
            $children = $element[$key]["children"];
            $value = ($children === []) ? formatValue($element[$key]["value"]) : '[complex value]';
            $action = $element[$key]["action"];

            if ($action === "Added") {
                $finalStirng = "Property '{$path}{$key}' was added with value: {$value}\n";
            } elseif ($action === "Changed") {
                $finalStirng = "Property '{$path}{$key}' was removed\n";
            } else {
                $newPath = "{$path}{$key}.";
                $finalStirng = makePlainFormat($children, $newPath);
            }
        } else {
            $key = array_key_first($element['Changed']);
            $oldChildren = $element['Changed'][$key]['children'];
            $newChildren = $element['Added'][$key]['children'];
            $newValue = ($newChildren === []) ? formatValue($element['Added'][$key]['value']) : '[complex value]';
            $oldValue = ($oldChildren === []) ? formatValue($element['Changed'][$key]['value']) : '[complex value]';
            $finalStirng = "Property '{$path}{$key}' was updated. From {$oldValue} to {$newValue}\n";
        }
        return $finalStirng;
    }, $diff);
    return implode($formatedDiff);
}


function formatValue(mixed $value)
{
    $normValue = normalizeValue($value);
    if ($normValue !== 'false' && $normValue !== 'true' && $normValue !== 'null' && !is_numeric($value)) {
        $newValue = "'{$value}'";
    } else {
        $newValue = $normValue;
    }
    return $newValue;
}

function normalizeValue(mixed $value)
{
    if ($value === true) {
        return 'true';
    } elseif ($value === false) {
        return 'false';
    } elseif ($value === null) {
        return 'null';
    } else {
        return $value;
    };
}
