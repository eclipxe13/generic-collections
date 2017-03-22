<?php
namespace GenericCollections\Tests;

use GenericCollections\Exceptions\OptionsException;
use GenericCollections\Options;
use PHPUnit\Framework\TestCase;

class OptionsTest extends TestCase
{
    public function testConstructor()
    {
        $options = new Options(0);
        // use assertSame to check also the internal type
        $this->assertSame(0, $options->getOptions());
        $this->assertSame(false, $options->optionAllowNullMembers());
        $this->assertSame(false, $options->optionUniqueValues());
        $this->assertSame(true, $options->optionComparisonIsIdentical());
    }

    public function testConstructorWithError()
    {
        $this->expectException(OptionsException::class);
        new Options('4');
    }

    public function providerMatrixAllOptions()
    {
        // 1, 2, 4 => 7
        return [
            [0, 0, 0, 0],
            [1, 0, 0, 1],
            [0, 1, 0, 2],
            [1, 1, 0, 3],
            [0, 0, 1, 4],
            [1, 0, 1, 5],
            [0, 1, 1, 6],
            [1, 1, 1, 7],
        ];
    }

    /**
     * @param int $uniquevalues
     * @param int $allownulls
     * @param int $comparisonequal
     * @param int $options
     * @dataProvider providerMatrixAllOptions
     */
    public function testMatrixAllOptions($uniquevalues, $allownulls, $comparisonequal, $options)
    {
        $object = new Options($options);
        $this->assertEquals($options, $object->getOptions());
        $this->assertEquals($uniquevalues, $object->optionUniqueValues());
        $this->assertEquals($allownulls, $object->optionAllowNullMembers());
        $this->assertEquals($comparisonequal, ! $object->optionComparisonIsIdentical());
    }
}
