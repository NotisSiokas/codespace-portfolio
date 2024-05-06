<?php

// Set the age variable
$age = 92;

// Determine age category using if-elseif-else structure
if ($age < 13) {
    // Child (under 13 years old)
    echo "You are a child"; 
} elseif ($age >= 13 && $age < 18) { // Changed from '>' to '>=' for accurate boundary
    // Teenager (13 to 17 years old)
    echo "You are a teenager";
} elseif ($age >= 18 && $age < 63) { // Changed from '>' to '>=' for accurate boundary
    // Adult (18 to 62 years old)
    echo "You are an adult";
} else {
    // Senior citizen (63 and older) 
    echo "You are a senior citizen"; 
}

?>
