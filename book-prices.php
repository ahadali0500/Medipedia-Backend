<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include("connection.php");

try {
    // Fetch all active books
    $qry = "SELECT * FROM books WHERE status = 1";
    $result = $con->query($qry);
    $books = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }

    // Book Bundle 1
    $qry1 = "SELECT * FROM books WHERE id IN (1,3,4,5,6,8) AND status = 1";
    $result1 = $con->query($qry1);
    $bookBundle1 = [];
    while ($row = mysqli_fetch_assoc($result1)) {
        $bookBundle1[] = $row;
    }

    // Book Bundle 2
    $qry2 = "SELECT * FROM books WHERE id IN (6,17,1,4,8,13,14,5) AND status = 1";
    $result2 = $con->query($qry2);
    $bookBundle2 = [];
    while ($row = mysqli_fetch_assoc($result2)) {
        $bookBundle2[] = $row;
    }

    // Mock Bundle 1
    $qry3 = "SELECT * FROM books WHERE id IN (2, 7, 9) AND status = 1";
    $result3 = $con->query($qry3);
    $mockBundle1 = [];
    while ($row = mysqli_fetch_assoc($result3)) {
        $mockBundle1[] = $row;
    }

    // Mock Bundle 2
    $qry4 = "SELECT * FROM books WHERE id IN (7, 9, 12, 15, 16, 18) AND status = 1";
    $result4 = $con->query($qry4);
    $mockBundle2 = [];
    while ($row = mysqli_fetch_assoc($result4)) {
        $mockBundle2[] = $row;
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


    // Return JSON response
    echo json_encode([
        "bookBundle1" => $bookBundle1,
        "bookBundle2" => $bookBundle2,
        "mockBundle1" => $mockBundle1,
        "mockBundle2" => $mockBundle2,
        "books" => $books,
        "bookcode1Price"=> $bookcode1Price, "bookcode2Price"=> $bookcode2Price, "mockcode3Price"=>$mockcode3Price,  "mockcode4Price"=>$mockcode4Price
    ]);

} catch (Exception $e) {
    // Handle any errors
    echo json_encode(["error" => $e->getMessage()]);
}

?>
