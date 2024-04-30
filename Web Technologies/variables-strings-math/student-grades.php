<?php

// Array to store student grades
$student_grades = array(
    "Aaron" => array("Physics" => 74, "English" => 69, "Maths" => 70),
    "Jamie" => array("Physics" => 64, "English" => 79, "Maths" => 69),
    "Harry" => array("Physics" => 55, "English" => 52, "Maths" => 57),
);

// Display specific student results:

echo "Aaron's Physics results: " . $student_grades["Aaron"]["Physics"] . "%\n";  // Access and display Aaron's Physics score
echo "Jamie's English results: " . $student_grades["Jamie"]["English"] . "%\n"; // Access and display Jamie's English score
echo "Harry's Maths results: " . $student_grades["Harry"]["Maths"] . "%\n";  // Access and display Harry's Maths score
?>