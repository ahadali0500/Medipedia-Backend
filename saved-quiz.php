<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");


function calculateTimeDifference($length, $targetHours, $targetMinutes, $targetSeconds) {
    // Variables for the calculated hours, minutes, and seconds
    $hours = 0;
    $minutes = 0;
    $seconds = 0;

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

    // Return the difference as an associative array
    return [
        'hours' => $diffHours,
        'minutes' => $diffMinutes,
        'seconds' => $diffSeconds
    ];
}



$user_id = $_POST['user_id'];
$qry = "SELECT DISTINCT test_id FROM quiz_save WHERE user_id = '$user_id'";
$result = $con->query($qry);

$test_ids = [];

// Fetch the result
while ($row = mysqli_fetch_assoc($result)) {
    $test_ids[] = $row['test_id'];
}

$data = [];

foreach ($test_ids as $key => $value) {
    $qry = "SELECT speclization.slug as spec_slug, books.slug as book_slug, papers.slug as paper_slug, test.slug as test_slug, test.test_name as test_name, test.id as test_id
    FROM `test`
    INNER JOIN `papers` ON test.paper_id = papers.id
    INNER JOIN `books` ON papers.book_id = books.id
    INNER JOIN `speclization` ON books.spec_id = speclization.id
    WHERE test.id='$value'";
    $result = $con->query($qry);
    
    while ($row = $result->fetch_assoc()) {
        $qryy = "SELECT * FROM quiz_save WHERE user_id = '$user_id' AND test_id = '$value'";
        $ress = mysqli_query($con, $qryy);
        $mark = 0;
        $total = 0;
        
        if (mysqli_num_rows($ress) > 0) {
            while ($dd = mysqli_fetch_assoc($ress)) {
                $mark += $dd['marks'];
                $total++;
                
                $targetHours = $dd['hour'];
                $targetMinutes = $dd['mint'];
                $targetSeconds = $dd['sec'];
            }
        }
        
        $qryyx = "SELECT * FROM skip WHERE user_id = '$user_id' AND test_id = '$value'";
        $resss = mysqli_query($con, $qryyx);
        
        if (mysqli_num_rows($resss) > 0) {
            while ($ddd = mysqli_fetch_assoc($resss)) {
                $mark += $ddd['marks'];
                $total++;
            }
        }
        
        $qryyxb = "SELECT * FROM question WHERE test_id = '$value'";
        $resssb = mysqli_query($con, $qryyxb);
        $length = mysqli_num_rows($resssb);
        
       
        
        
       
// Add the calculated data to the result array
$row['marks'] = $mark;


$timeDifference = calculateTimeDifference($length, $targetHours, $targetMinutes, $targetSeconds);
$row['time']=$timeDifference['hours'] . "h: " . $timeDifference['minutes'] . "m: " . $timeDifference['seconds'] . "s";
$row['targetHours'] = $targetHours;
$row['targetMinutes'] = $targetMinutes;
$row['targetSeconds'] = $targetSeconds;

$data[] = $row;

    }
}

// Output the result as JSON
echo json_encode(array("data" => $data));
?>
