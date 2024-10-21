<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");
$user_id=$_POST['user_id'];




$qry = "SELECT * FROM books_codes INNER JOIN books ON books_codes.book_id = books.id WHERE books_codes.user_id = '$user_id' AND books_codes.type=0";
$result = $con->query($qry);
$code=[];
while($ddd=mysqli_fetch_assoc($result)){
    $code[]=$ddd;
}


$qryc1 = "SELECT * FROM `books_codes` WHERE `user_id`= '$user_id' AND `type`='-1'";
$resultc1 = mysqli_query($con, $qryc1);
$bookcode1 = [];

if (mysqli_num_rows($resultc1) > 0) {
    $qry = "SELECT books.*, books_codes.user_code AS user_code, books_codes.status AS bcs, books_codes.type AS bookType 
            FROM books
            LEFT JOIN books_codes ON books.id = books_codes.book_id AND books_codes.user_id = '$user_id'
            WHERE books.id IN (1,3,4,5,6,8)
            AND books.status = '1' AND books_codes.type = '-1'";
    $dd = mysqli_query($con, $qry);
    if ($dd) {
        while ($ddd = mysqli_fetch_assoc($dd)) {
            $bookcode1[] = $ddd;
        }
    } else {
        echo "Error in Query 2: " . $con->error;
    }
}


$qryc2 = "SELECT * FROM `books_codes` WHERE `user_id`= '$user_id' AND `type`='-3'";
$resultc2 = mysqli_query($con, $qryc2);
$bookcode2 = [];

if (mysqli_num_rows($resultc2) > 0) {
    $qry2 = "SELECT books.*, books_codes.user_code AS user_code, books_codes.status AS bcs, books_codes.type AS bookType 
            FROM books
            LEFT JOIN books_codes ON books.id = books_codes.book_id AND books_codes.user_id = '$user_id'
            WHERE books.id IN (6,17,1,4,8,13,14,5)
            AND books.status = '1' AND books_codes.type = '-3'";
    $dd2 = mysqli_query($con, $qry2);
    if ($dd2) {
        while ($ddd2 = mysqli_fetch_assoc($dd2)) {
            $bookcode2[] = $ddd2;
        }
    } else {
        echo "Error in Query 2: " . $con->error;
    }
}



// $qry = "SELECT * FROM books_codes INNER JOIN books ON books_codes.book_id = books.id WHERE books_codes.user_id = '$user_id' AND books_codes.type=-1";
// $result = $con->query($qry);
// $bookcode1=[];
// while($ddd=mysqli_fetch_assoc($result)){
//     $bookcode1[]=$ddd;
// }


// $qry = "SELECT * FROM books_codes INNER JOIN books ON books_codes.book_id = books.id WHERE books_codes.user_id = '$user_id' AND books_codes.type=-3";
// $result = $con->query($qry);
// $bookcode2=[];
// while($ddd=mysqli_fetch_assoc($result)){
//     $bookcode2[]=$ddd;
// }


$qryc3 = "SELECT * FROM `books_codes` WHERE `user_id`= '$user_id' AND `type`='-2'";
$resultc3 = mysqli_query($con, $qryc3);
$mockcode1 = [];

if (mysqli_num_rows($resultc3) > 0) {
    $qry3 = "SELECT books.*, books_codes.user_code AS user_code, books_codes.status AS bcs, books_codes.type AS bookType 
            FROM books
            LEFT JOIN books_codes ON books.id = books_codes.book_id AND books_codes.user_id = '$user_id'
            WHERE books.id IN (2, 7, 9)
            AND books.status = '1' AND books_codes.type = '-2' ";
    $dd3 = mysqli_query($con, $qry3);
    if ($dd3) {
        while ($ddd3 = mysqli_fetch_assoc($dd3)) {
            $mockcode1[] = $ddd3;
        }
    } else {
        echo "Error in Query 2: " . $con->error;
    }
}


// $qry = "SELECT * FROM books_codes INNER JOIN books ON books_codes.book_id = books.id WHERE books_codes.user_id = '$user_id' AND books_codes.type=-2";
// $result = $con->query($qry);
// $mockcode1=[];
// while($ddd=mysqli_fetch_assoc($result)){
//     $mockcode1[]=$ddd;
// }

// $qry = "SELECT * FROM books_codes INNER JOIN books ON books_codes.book_id = books.id WHERE books_codes.user_id = '$user_id' AND books_codes.type=-4";
// $result = $con->query($qry);
// $mockcode2=[];
// while($ddd=mysqli_fetch_assoc($result)){
//     $mockcode2[]=$ddd;
// }

$qryc4 = "SELECT * FROM `books_codes` WHERE `user_id`= '$user_id' AND `type`='-4'";
$resultc4 = mysqli_query($con, $qryc4);
$mockcode2 = [];

if (mysqli_num_rows($resultc4) > 0) {
    $qry4 = "SELECT books.*, books_codes.user_code AS user_code, books_codes.status AS bcs, books_codes.type AS bookType 
            FROM books
            LEFT JOIN books_codes ON books.id = books_codes.book_id AND books_codes.user_id = '$user_id'
            WHERE books.id IN (7, 9, 12, 15, 16, 18)
            AND books.status = '1' AND books_codes.type = '-4'";
    $dd4 = mysqli_query($con, $qry4);
    if ($dd4) {
        while ($ddd4 = mysqli_fetch_assoc($dd4)) {
            $mockcode2[] = $ddd4;
        }
    } else {
        echo "Error in Query 2: " . $con->error;
    }
}


$p1="SELECT * FROM `books` WHERE `id`= 10 ";
$pp1 = mysqli_query($con, $p1);
$ppp1= mysqli_fetch_assoc($pp1);
$bookcode1Price=$ppp1['book_price'];

$p2="SELECT * FROM `books` WHERE `id`= 19 ";
$pp2 = mysqli_query($con, $p2);
$ppp2= mysqli_fetch_assoc($pp2);
$bookcode2Price=$ppp2['book_price'];

$p3="SELECT * FROM `books` WHERE `id`= 11 ";
$pp3 = mysqli_query($con, $p3);
$ppp3= mysqli_fetch_assoc($pp3);
$mockcode3Price=$ppp3['book_price'];

$p4="SELECT * FROM `books` WHERE `id`= 20 ";
$pp4 = mysqli_query($con, $p4);
$ppp4= mysqli_fetch_assoc($pp4);
$mockcode4Price=$ppp4['book_price'];

echo json_encode(array("code" => $code,"bookcode1"=>$bookcode1 ,"bookcode2"=>$bookcode2, "mockcode1"=>$mockcode1,  "mockcode2"=>$mockcode2, "bookcode1Price"=> $bookcode1Price, "bookcode2Price"=> $bookcode2Price, "mockcode3Price"=>$mockcode3Price,  "mockcode4Price"=>$mockcode4Price));


?>