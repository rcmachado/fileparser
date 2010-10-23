<?php
require 'FP/SubstringFile.php';
/*
first-field-with-26-charsHERESTARTSSECONDFIELD             FIELD_AFTER_13_BLANKS
0987654321098765432109876-54321098765432109876---ignored---543210987654321098765
*/
class FP_SubstringFileTest extends PHPUnit_Framework_TestCase {
    function testIterateOverFileReturnsParsedFieldsForEachLine() {
        $filename = FIXTURES_DIR . '/_files/substr.txt';
        $format = array(
            array('size' => 25),
            array('size' => 21),
            array('size' => 13, 'skip' => true),
            array('size' => 21),
        );

        $expected_fields = array(
            array(
                'first-field-with-26-chars',
                'HERESTARTSSECONDFIELD',
                'FIELD_AFTER_13_BLANKS',
            ),
            array(
                '0987654321098765432109876',
                '-54321098765432109876',
                '543210987654321098765',
            ),
            null, // an empty line
        );

        $file = new FP_SubstringFile($filename, array('format' => $format));
        foreach ($file as $line_number => $fields) {
            $this->assertEquals($expected_fields[$line_number], $fields);
        }
    }

    /**
     * @expectedException UnexpectedValueException
     */
    function testParseAndValidateValuesOfEachFied() {
        $filename = FIXTURES_DIR . '/_files/substr.txt';
        $format = array(
            array('size' => 25, 'validate_using_re' => '/\w+\d+\-/'),
            array('size' => 21),
            array('size' => 13, 'skip' => true),
            array('size' => 21),
        );

        $expected_fields = array(
            array(
                'first-field-with-26-chars',
                'HERESTARTSSECONDFIELD',
                'FIELD_AFTER_13_BLANKS',
            ),
            array(
                '0987654321098765432109876',
                '-54321098765432109876',
                '543210987654321098765',
            ),
            null, // an empty line
        );

        $file = new FP_SubstringFile($filename, array('format' => $format));
        foreach ($file as $line_number => $fields) {
            // this will be executed for first line,
            // but will thrown an Exception on second
            $this->assertEquals($expected_fields[$line_number], $fields);
        }
    }
}
?>