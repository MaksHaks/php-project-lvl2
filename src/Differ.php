<?php

namespace Differ\Differ;

use function Differ\Parser\parse;
use function Differ\Formatters\render;
use function Functional\sort;

function genDiff(string $firstPath, string $secondPath, string $format = "stylish"): string
{
    $firstFileContent = parse($firstPath);
    $secondFileContent = parse($secondPath);
    $diff = findDiff($firstFileContent, $secondFileContent);
    return render($diff, $format);
}

function findDiff(array $firstFile, array $secondFile): array
{
    $uniqueKeys = array_unique(array_merge(array_keys($firstFile), array_keys($secondFile)));
    $sortedUniqueKeys = sort($uniqueKeys, fn (string $left, string $right) => strcmp($left, $right));

    $difference = array_map(function ($key) use ($firstFile, $secondFile) {

        if (array_key_exists($key, $firstFile) && array_key_exists($key, $secondFile)) {
            if (is_array($firstFile[$key]) && is_array($secondFile[$key])) {
                $node = generateNode($key, 'Unchanged', '', findDiff($firstFile[$key], $secondFile[$key]));
            } elseif (!is_array($firstFile[$key]) && !is_array($secondFile[$key])) {
                if ($firstFile[$key] === $secondFile[$key]) {
                    $node = generateNode($key, 'Unchanged', $firstFile[$key]);
                } else {
                    $changedItem = generateNode($key, 'Changed', $firstFile[$key]);
                    $addedItem = generateNode($key, 'Added', $secondFile[$key]);
                    $node = ["Changed" => $changedItem, "Added" => $addedItem];
                }
            } elseif (is_array($firstFile[$key]) && !is_array($secondFile[$key])) {
                $changedItem =  generateNode($key, 'Changed', '', normalizeNode($firstFile[$key]));
                $addedItem = generateNode($key, 'Added', $secondFile[$key]);
                $node = ["Changed" => $changedItem, "Added" => $addedItem];
            } else {
                $changedItem =  generateNode($key, 'Changed', $firstFile[$key]);
                $addedItem = generateNode($key, 'Added', '', normalizeNode($secondFile[$key]));
                $node = ["Changed" => $changedItem, "Added" => $addedItem];
            }
        } elseif (array_key_exists($key, $firstFile)) {
            if (is_array($firstFile[$key])) {
                $node = generateNode($key, 'Changed', '', normalizeNode($firstFile[$key]));
            } else {
                $node = generateNode($key, 'Changed', $firstFile[$key]);
            }
        } else {
            if (is_array($secondFile[$key])) {
                $node = generateNode($key, 'Added', '', normalizeNode($secondFile[$key]));
            } else {
                $node = generateNode($key, 'Added', $secondFile[$key]);
            }
        }
        return $node;
    }, $sortedUniqueKeys);

    return $difference;
}

function generateNode(string $key, string $action, mixed $value, array $children = []): array
{
    $nodeContent = ["action" => $action, "value" => $value, "children" => $children];
    $node = [$key => $nodeContent];
    return $node;
}

function normalizeNode(array $node)
{
    $nodeKeys = sort(array_keys($node), fn (string $left, string $right) => strcmp($left, $right));
    $finalNode = array_map(function ($nodeKey) use ($node) {
        $action = 'Unchanged';
        $value = (!is_array($node[$nodeKey])) ? $node[$nodeKey] : '';
        $key = $nodeKey;
        $children = (!is_array($node[$nodeKey])) ? [] : normalizeNode($node[$nodeKey]);
        $nodeContent = ["action" => $action, "value" => $value, "children" => $children];
        $normalizedNode = [$key => $nodeContent];
        return $normalizedNode;
    }, $nodeKeys);
    return $finalNode;
}
