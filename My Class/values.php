<?php

/*
 * In this file I declare the values for multiple choices inputs. (checkbox, radio, select)
 * This way I can access it from anywhere.
 * I also declare the overallName of the checkboxes to access it easily
 */

// Values
$chkValues = array(
    'test1' => 'this is a test',
    'test2' => 'another test but not checked',
    'test3' => 'another test - 3',
);

$rdbValues = array(
    'test' => 'this is a test',
    'test2' => 'another test but not checked'
);

$sctValues = array(
    '1' => 'first',
    '2' => 'second and selected',
    '3' => 'third'
);

// Checkbox
$chkName = 'chkName';
$_SESSION[$chkName] = 'chk';

// Radiobutton
$rdbName = 'rdb';
