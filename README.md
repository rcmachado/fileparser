FP FileParser
=============

Provides differents file wrappers to parse text files.

Requirements
------------

 * PHP 5.1+ (it depends on [SplFileObject](http://php.net/splfileobject) class)

License
-------

This project is licensed under MIT LICENSE. See file LICENSE or visit
[http://www.opensource.org/licenses/mit-license.html](http://www.opensource.org/licenses/mit-license.html)
for more information.

Installation
------------

For now, simply copy the FP folder to your project.

Parsers
-------

Currently, only FP_SubstringFile is available.

### SubstringFile

Parse each line of a file using substring positions. Empty lines are returned
as `null` values.

Example:

    <?php
    require 'FP/SubstringFile.php';
    $options = array(
        'format' => array(
            // a field with the first 10 chars of line
            array('size' => 10),
            // we will skip the next 5 chars
            array('size' => 5, 'skip' => true),
            // then retrieve the next 15 chars, validating against a regexp
            array('size' => 15, 'validate_using_re' => '/\w+\d+/'),
        ),
    );

    $file = new FP_SubstringFile('myfile.txt', $options);
    foreach ($file as $fields) {
        // $fields is the various fields that
        // you especified in $options['format']
    }
    ?>

Contributing
------------

 * Fork this project and send-me a pull request OR
 * Or just send a patch (you can create one using `git format-patch`) to
   rcmachado@gmail.com

If possible, write an unit test for your feature or bugfix.

TO-DO list:

 * Better documentation
 * New wrappers (RegExp, ...)
 * PEAR installation (package.xml file)
