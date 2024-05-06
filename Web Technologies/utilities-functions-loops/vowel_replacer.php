<?php

// Defines a function to replace vowels with 'x'
function replaceVowelsWithX($str) {
    // Array of lowercase and uppercase vowels
    $vowels = array('a', 'e', 'i', 'o', 'u','A', 'E', 'I', 'O', 'U');  

    // Replaces vowels with 'x' and returns the modified string 
    return str_replace($vowels, "x", $str); 
}

// Input string 
$input = "Star Wars: The Empire Strikes Back";

// Calls the function to modify the input string
$output = replaceVowelsWithX($input);

// Displays the modified string
echo $output;  

?>
