<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

function mergeData($datass, $qz, $mergeCount) {
    // Get the subset of records from qz based on $mergeCount
    $qzSubset = array_slice($qz, 0, $mergeCount);

    // Merge qzSubset into the first $mergeCount records of datass
    $mergedData = array_map(function($question, $index) use ($qzSubset) {
        // Check if index is within the range of qzSubset
        if ($index < count($qzSubset)) {
            // Merge the t_ans value from qz into the setoptans field of the question object
            return array_merge($question, [
                'setoptans' => $qzSubset[$index]['t_ans'],
                'sel_ans' => $qzSubset[$index]['f_ans'],
                'hour' => $qzSubset[$index]['hour'],
                'sec' => $qzSubset[$index]['sec'],
                'mint' => $qzSubset[$index]['mint']


            ]);
        } else {
            // If index is beyond the range of qzSubset, keep the original question
            return $question;
        }
    }, $datass, array_keys($datass));

    return $mergedData;
}




$slug = $_POST['slug'];
$qry = "SELECT * FROM test WHERE slug = '$slug'";
$out = $con->query($qry);
if(mysqli_num_rows($out)>0){

    $rows = $out->fetch_assoc();
    $test_id = $rows['id'];
    $user_id = $_POST['user_id'];

    $aa = "SELECT * FROM `quiz_save` WHERE user_id='$user_id' AND test_id='$test_id'";
    $aac = mysqli_query($con, $aa);
    if (mysqli_num_rows($aac) > 0) {
        // If there are saved answers for this test by this user
        // total Question length
        $qry = "SELECT * FROM question WHERE test_id = '$test_id' AND status = '1'";
        $result = $con->query($qry);
        $questions = array();

        // Loop through each row fetched
        while ($ques = $result->fetch_assoc()) {
            // Store the fetched row in the array
            $questions[] = $ques;
        }
        $totalRows = count($questions);

        $qry = "SELECT * FROM question WHERE test_id = '$test_id' and status = '1'";
        $result = $con->query($qry);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $ques_id = $row['id'];
            // Check if the question is skipped by the user
            $aa = "SELECT * FROM `skip` WHERE user_id='$user_id' AND test_id='$test_id' AND ques_id='$ques_id'";
            $aac = mysqli_query($con, $aa);
            if (!mysqli_num_rows($aac) > 0) {
                // If the question is not skipped, add it to data

                $row['sel_ans'] = null;
                $row['setoptans'] = null;
                $row['skip'] = false;
                $data[] = $row;
            }
        }
        $ques=$result->fetch_assoc();

        $qry = "SELECT question.*, skip.status AS skipstatus FROM question LEFT JOIN skip ON skip.ques_id = question.id WHERE skip.user_id = '$user_id' AND skip.test_id = '$test_id';";
        $result = $con->query($qry);

        $skiparr = [];
        while ($row = $result->fetch_assoc()) {
            // For each question, add it to data with default values
            $row['sel_ans'] = null;
            $row['setoptans'] = null;
            $row['skip'] = false;
            $skiparr[] = $row;
        }


        $qry = "SELECT * FROM quiz_save WHERE  user_id = '$user_id' AND test_id = '$test_id'";
        $result = $con->query($qry);

        $quiz_save = [];
        $marks=0;
        while ($row = $result->fetch_assoc()) {
            $quiz_save[] = $row;
            if ($row['marks']==1) {
                $marks++;
            }
        
        }

        $mergedData = mergeData($data, $quiz_save,count($quiz_save));
        if ($totalRows===count($quiz_save)+count($skiparr)) {
            $shuuflephase=true;
        }else{
            $shuuflephase=false;
        }
        echo json_encode(array("heading" => $rows['test_name'], "type" => "save", "mergedData" => $mergedData, "skiparr"=> $skiparr, "quiz_save"=>$quiz_save, "marks"=> $marks,"shuuflephase"=>$shuuflephase ,"index"=>count($quiz_save), "testId"=>$test_id));

    } else {
        // If there are no saved answers for this test by this user
        $qry = "SELECT * FROM question WHERE test_id = '$test_id' and status = '1'";
        $result = $con->query($qry);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            // For each question, add it to data with default values
            $row['sel_ans'] = null;
            $row['setoptans'] = null;
            $row['skip'] = false;
            $data[] = $row;
        }
        echo json_encode(array("heading" => $rows['test_name'], "type" => "new", "data" => $data, "testId"=>$test_id));
    }
}else{
    echo json_encode(array("heading" => "No data found", "type" => "new", "data" => []));

}
?>
