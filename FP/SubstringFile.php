<?php
require dirname(__FILE__) . '/GenericFile.php';

/**
 * Parses file using substr().
 *
 * This parser accepts, as format, an array for each field, with the following
 * information:
 * <ul>
 * <li><b>(int) size</b>: Size of field</li>
 * <li><b>(bool) skip</b>: If true, this field will not be included in results
 * (useful if it only has blank spaces, for example)</li>
 * <li><b>validate_using_re</b>: Regular expression used to validate the value.
 * If the value doesn't validate, an UnexpectedValueException is thrown.</li>
 * </ul>
 *
 * @package FP
 * @author Rodrigo Machado <rcmachado@gmail.com>
 */
class FP_SubstringFile extends FP_GenericFile {
    /**
     * Parsers each line according to previous specified format.
     *
     * This method is called each time a line is read from archive. Throws an
     * UnexpectedValueException if the value can't be validated using informed
     * regular expression.
     *
     * @param string $line Line that will be parsed
     * @return array Array with fields of this line
     * @throws UnexpectedValueException
     */
    protected function parseLine($line) {
        if (!$line) {
            return null;
        }

        $format = $this->options['format'];

        $fields = array();
        $last_pos = 0;
        foreach ($format as $name => $substr_opt) {
            if ($substr_opt['skip'] === true) {
                $last_pos = $last_pos + $substr_opt['size'];
                continue;
            }

            $value = substr($line, $last_pos, $substr_opt['size']);
            $last_pos = $last_pos + $substr_opt['size'];

            if ($substr_opt['validate_using_re']) {
                $regexp = $substr_opt['validate_using_re'];
                if (!preg_match($regexp, $value)) {
                    $msg = "Value $value doesn't match regexp $regexp";
                    throw new UnexpectedValueException($msg);
                }
            }

            $fields[] = $value;
        }

        return $fields;
    }
}
?>