<?php

    /* Assign the age*/
    $age= 26;

    /* Calculate days, hours, minutes based on the $age*/
    $days = $age * 365;
    $hours = $days * 24;
    $minutes = $hours * 60;

    /*Echo the results */
    echo "Welcome to the Age Calculator!". PHP_EOL;
    echo "\n";
    echo "Your age is: ".$age. PHP_EOL;
    echo "\n";
    echo "You have been alive for: ". PHP_EOL;
    echo $days."days.". PHP_EOL;
    echo $hours."hours.". PHP_EOL;
    echo $minutes."minutes". PHP_EOL;
?>