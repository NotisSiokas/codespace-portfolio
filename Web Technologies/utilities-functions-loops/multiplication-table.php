<?php

// Retrieve the number from a form submission (assuming POST method)
$num = $_POST['num'];

// Display a title with the number
echo "Below is the Multiplication Table of $num: <br>";

// Loop to generate the multiplication table
for ($i = 1; $i <= 10; $i++) {
    // Calculate the product for the current row
    $result = $num * $i;

    // Display the result in a new line
    echo "$result <br>"; 
}

?>
