<?php

namespace Differ\Formatters\Stylish;

use Exception;

const TAB = 4;
const SYMBOLS_SPACE = 2;

function formatStylish(array $diff)
{
    $formatedDiff = makeStylishFormat($diff);
    return "{\n{$formatedDiff}}";
}

function makeStylishFormat(array $diff, int $depth = 1)
{
    $formatedDiff = array_map(function ($element) use ($depth) {

        if (!array_key_exists("Changed", $element)) {
            $key = array_key_first($element);
            $value = normalizeValue($element[$key]["value"]);
            $action = normalizeAction($element[$key]["action"]);
            $children = $element[$key]["children"];
            $currentTab = str_repeat(' ', ($depth * TAB - SYMBOLS_SPACE));

            if ($children !== []) {
                $childrenData = makeStylishFormat($children, $depth + 1);
                $childrens = "{\n{$childrenData}{$currentTab}  }";
            } else {
                $childrens = '';
            }
            return "{$currentTab}{$action} {$key}: {$value}{$childrens}\n";
        } else {
            return makeStylishFormat($element, $depth);
        }
    }, $diff);
    return implode($formatedDiff);
}

function normalizeAction(string $action): string
{
    switch ($action) {
        case 'Changed':
            $normalizedAction = '-';
            break;
        case 'Unchanged':
            $normalizedAction = ' ';
            break;
        case 'Added':
            $normalizedAction = '+';
            break;
        default:
            throw new Exception('Undefined action');
    }

    return $normalizedAction;
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
