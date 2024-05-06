<?php

// Defines a calculator function
function Calculator($num1, $num2, $calculation) {
    // Checks if both inputs are integers
    if (is_int($num1) && is_int($num2)) {
        // Uses a switch statement to select the appropriate calculation
        switch ($calculation) {
            case "Addition": 
                return $num1 + $num2;
            case "Subtraction": 
                return $num1 - $num2;
            case "Multiplication": 
return $num1 * $num2;
            case "Division": 
                return $num1 / $num2;
        }
    } else {
        // Error message if inputs are not integers
        echo "Please type a number";
    }
};

// Handles form submission (assuming this code is in calculator.php)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Converts form inputs to integers
    $num1 = (int)$_POST['num1']; 
    $num2 = (int)$_POST['num2']; 
    $calculation = $_POST['calculation'];

    // Calls the Calculator function to perform the calculation
    $result = Calculator($num1, $num2, $calculation);

    // Displays the calculation result
    echo $result;
}
