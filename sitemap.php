<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

$arr=array();
// Guide
$qry = "SELECT * FROM speclization WHERE status = '1'";
$result = mysqli_query($con, $qry);
    if(mysqli_num_rows($result) > 0) {
        while($data = mysqli_fetch_assoc($result)){
            array_push($arr, "https://medipedia.vercel.app/guide/" . $data['slug']);
        }
    }


    // books
$qry = "SELECT * FROM speclization WHERE status = '1'";
$result = mysqli_query($con, $qry);
if(mysqli_num_rows($result) > 0) {
    while($data = mysqli_fetch_assoc($result)){
      
    $spec_id=$data['id'];

    $qrybook = "SELECT * FROM books WHERE `spec_id`='$spec_id'  AND status = '1'";
    $resultbook = mysqli_query($con, $qrybook);
    if(mysqli_num_rows($resultbook) > 0) {
        while($databook = mysqli_fetch_assoc($resultbook)){
            array_push($arr, "https://medipedia.vercel.app/guide/" . $data['slug']. '/'. $databook['slug']);
        }
    }



    }
}


// papers
$qry = "SELECT * FROM speclization WHERE status = '1'";
$result = mysqli_query($con, $qry);
if(mysqli_num_rows($result) > 0) {
    while($data = mysqli_fetch_assoc($result)){
      
    $spec_id=$data['id'];

    $qrybook = "SELECT * FROM books WHERE `spec_id`='$spec_id'  AND status = '1'";
    $resultbook = mysqli_query($con, $qrybook);
    if(mysqli_num_rows($resultbook) > 0) {
        while($databook = mysqli_fetch_assoc($resultbook)){
             
            $book_id=$databook['id'];

            $qrypapers = "SELECT * FROM papers WHERE `book_id`='$book_id'  AND status = '1'";
            $resultpapers = mysqli_query($con, $qrypapers);
            if(mysqli_num_rows($resultpapers) > 0) {
                while($datapapers = mysqli_fetch_assoc($resultpapers)){
                array_push($arr, "https://medipedia.vercel.app/guide/" . $data['slug']. '/'. $databook['slug']. '/'. $datapapers['slug']);

                }
            }


        }
    }



    }
}



// Tests
$qry = "SELECT * FROM speclization WHERE status = '1'";
$result = mysqli_query($con, $qry);
if(mysqli_num_rows($result) > 0) {
    while($data = mysqli_fetch_assoc($result)){
      
    $spec_id=$data['id'];

    $qrybook = "SELECT * FROM books WHERE `spec_id`='$spec_id'  AND status = '1'";
    $resultbook = mysqli_query($con, $qrybook);
    if(mysqli_num_rows($resultbook) > 0) {
        while($databook = mysqli_fetch_assoc($resultbook)){
             
            $book_id=$databook['id'];

            $qrypapers = "SELECT * FROM papers WHERE `book_id`='$book_id'  AND status = '1'";
            $resultpapers = mysqli_query($con, $qrypapers);
            if(mysqli_num_rows($resultpapers) > 0) {
                while($datapapers = mysqli_fetch_assoc($resultpapers)){

                    $paper_id=$datapapers['id'];
                    $qrytest = "SELECT * FROM test WHERE `paper_id`='$paper_id'  AND status = '1'";
                    $resulttest = mysqli_query($con, $qrytest);
                    if(mysqli_num_rows($resulttest) > 0) {
                        while($datatest = mysqli_fetch_assoc($resulttest)){
                        array_push($arr, "https://medipedia.vercel.app/guide/" . $data['slug']. '/'. $databook['slug']. '/'. $datapapers['slug']. '/'. $datatest['slug']);

                        }
                    }

                }
            }


        }
    }



    }
}




 echo json_encode($arr);
?>

