<?php

namespace Differ\Formatters\Stylish;

use Exception;

const TAB = 4;
const SYMBOLS_SPACE = 2;

function render(array $diff)
{
    $formatedDiff = makeStylishFormat($diff);
    return "{\n{$formatedDiff}}";
}

function makeStylishFormat(array $diff, int $depth = 1)
{
    $formatedDiff = array_map(function ($element) use ($depth) {

        if (!array_key_exists("Changed", $element)) {
            $key = $element['key'];
            $value = normalizeValue($element["value"]);
            $type = normalizeType($element["type"]);
            $children = $element["children"];
            $currentTab = str_repeat(' ', ($depth * TAB - SYMBOLS_SPACE));

            if ($children !== []) {
                $childrenData = makeStylishFormat($children, $depth + 1);
                $childrens = "{\n{$childrenData}{$currentTab}  }";
            } else {
                $childrens = '';
            }
            return "{$currentTab}{$type} {$key}: {$value}{$childrens}\n";
        } else {
            return makeStylishFormat($element, $depth);
        }
    }, $diff);
    return implode($formatedDiff);
}

function normalizeType(string $type): string
{
    switch ($type) {
        case 'Changed':
            return '-';
        case 'Deleted':
            return '-';
        case 'Unchanged':
            return ' ';
        case 'Added':
            return '+';
        default:
            throw new Exception('Undefined type');
    }
}

function normalizeValue(mixed $value)
{
    if ($value === true) {
        return 'true';
    }
    if ($value === false) {
        return 'false';
    }
    if ($value === null) {
        return 'null';
    }
    return $value;
}
