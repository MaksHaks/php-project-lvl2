<?php

namespace Differ\Tests\DifferTest;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class DifferTest extends TestCase
{
    /**
     * @dataProvider diffProvider
     */
    public function testDiff($expected, $options): void
    {
        $result = genDiff(...$options);
        $this->assertStringEqualsFile($expected, $result);
    }

    public function diffProvider(): array
    {
        $expectedPlain = __DIR__ . "/fixtures/expectedPlain.txt";
        $expectedStylish = __DIR__ . "/fixtures/expectedStylish.txt";
        $expectedJson1 = __DIR__ . "/fixtures/expectedJson.txt";
        $expectedJson2 = __DIR__ . "/fixtures/expectedJson2.txt";

        $firstYaml = __DIR__ . "/fixtures/file1.yaml";
        $secondYaml = __DIR__ . "/fixtures/file2.yaml";
        $firstJson = __DIR__ . "/fixtures/file1.json";
        $secondJson = __DIR__ . "/fixtures/file2.json";

        $optionsPlain = [$firstYaml, $secondYaml, 'plain'];
        $optionsStylish = [$firstYaml, $secondYaml];
        $optionsJson1 = [$firstYaml, $secondYaml, 'json'];
        $optionsJson2 = [$firstJson, $secondJson, 'json'];

        return  [
            [$expectedPlain, $optionsPlain],
            [$expectedStylish, $optionsStylish],
            [$expectedJson1, $optionsJson1],
            [$expectedJson2, $optionsJson2]
        ];
    }
}
