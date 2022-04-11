<?php

namespace Php\Project\Lvl2\Tests\DifferTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    /**
     * @dataProvider diffProvider
     */
    public function testDiff($expected, $result): void
    {
        $this->assertEquals($expected, $result);
    }

    public function diffProvider(): array
    {
        $expected1 = file_get_contents(__DIR__ . "/fixtures/expectedPlain.txt");
        $expected2 = file_get_contents(__DIR__ . "/fixtures/expectedStylish.txt");
        $expected3 = file_get_contents(__DIR__ . "/fixtures/expectedJson.txt");
        $expected4 = file_get_contents(__DIR__ . "/fixtures/expectedJson2.txt");

        $firstYaml = __DIR__ . "/fixtures/file1.yaml";
        $secondYaml = __DIR__ . "/fixtures/file2.yaml";
        $firstJson = __DIR__ . "/fixtures/file1.json";
        $secondJson = __DIR__ . "/fixtures/file2.json";

        $result1 = genDiff($firstYaml, $secondYaml, 'plain');
        $result2 = genDiff($firstYaml, $secondYaml);
        $result3 = genDiff($firstYaml, $secondYaml, 'json');
        $result4 = genDiff($firstJson, $secondJson, 'json');

        return  [
            [$expected1, $result1], [$expected2, $result2], [$expected3, $result3], [$expected4, $result4]
        ];
    }
}
