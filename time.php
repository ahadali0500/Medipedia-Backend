<?php

// Variables for the calculated hours, minutes, and seconds
$hours = 0;
$minutes = 0;
$seconds = 0;

$length=25;
// Calculate hours based on the $length variable
if ($length <= 50) {
    $hours = 1;
} else if ($length <= 100) {
    $hours = 2;
} else if ($length <= 200) {
    $hours = 3;
} else if ($length <= 300) {
    $hours = 4;
} else {
    $additionalHours = ceil(($length - 300) / 100);
    $hours = 4 + $additionalHours;
}

// Assuming $dd is an array that holds the target time 'hour', 'mint', and 'sec'
$targetHours = 0;
$targetMinutes = 59;
$targetSeconds = 55;

// Convert both current calculated time and target time to seconds
$currentTotalSeconds = $hours * 3600 + $minutes * 60 + $seconds;
$targetTotalSeconds = $targetHours * 3600 + $targetMinutes * 60 + $targetSeconds;

// Calculate the difference in seconds
$diffSeconds = abs($currentTotalSeconds - $targetTotalSeconds);

// Convert the difference back to hours, minutes, and seconds
$diffHours = floor($diffSeconds / 3600);
$diffSeconds -= $diffHours * 3600;
$diffMinutes = floor($diffSeconds / 60);
$diffSeconds -= $diffMinutes * 60;

// Now $diffHours, $diffMinutes, and $diffSeconds hold the absolute difference between the two times
echo "Difference: {$diffHours} hours, {$diffMinutes} minutes, and {$diffSeconds} seconds";
