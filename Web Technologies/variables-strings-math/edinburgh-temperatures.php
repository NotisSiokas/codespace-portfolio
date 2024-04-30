<?php

// Create an associative array to store climate data for Edinburgh
$edinburgh_climate = array(
    "July-Aug" => array(
        "High" => 19,
        "Low" => 11),  // Celsius values
    "Jan-Feb" => array(
        "High" => 7,
        "Low" => 1)       // Celsius values
);

// Print table header
echo "Average Temperature in Edinburgh\n";
echo "Month\t\t\tHigh\tLow\n"; // Updated header for Celsius

// Access and print data directly
echo "July-Aug\t\t" . $edinburgh_climate["July-Aug"]['High'] . "\t\t" . $edinburgh_climate["July-Aug"]['Low'] . "\n";
echo "Jan-Feb\t\t" . $edinburgh_climate["Jan-Feb"]['High'] . "\t\t" . $edinburgh_climate["Jan-Feb"]['Low'] . "\n";
?>

