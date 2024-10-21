<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
include("connection.php");

// fetching id from slug
$slug = $_POST['slug'];
$user_id = $_POST['user_id'];
$books_idd = "";
$price=0;

$mock_idd = "";
$mock_price=0;

if(isset($_POST['bookBundle'])){
    $bookBundle = $_POST['bookBundle'];
    $qry = "SELECT * FROM books WHERE slug = '$bookBundle'";
    $out = $con->query($qry);
    if ($out->num_rows > 0) {
        $rows = $out->fetch_assoc();
        $books_idd = $rows['id'];
        $price= $rows['book_price'];
    }
}

if(isset($_POST['mockBundle'])){
    $mockBundle = $_POST['mockBundle'];
    $qry = "SELECT * FROM books WHERE slug = '$mockBundle'";
    $out = $con->query($qry);
    if ($out->num_rows > 0) {
        $rows = $out->fetch_assoc();
        $mock_idd = $rows['id'];
        $mock_price= $rows['book_price'];
    }
}

$qry = "SELECT * FROM speclization WHERE slug = '$slug'";
$out = $con->query($qry);
$rows = $out->fetch_assoc();
$spec_id = $rows['id'];

if ($spec_id == 2) {   // all books
    $qry = "";
    if ($books_idd == 10) {
        $qry = "SELECT DISTINCT  books.*, books_codes.user_code AS bk, books_codes.status AS bcs
                FROM books
                LEFT JOIN books_codes ON books.id = books_codes.book_id AND books_codes.user_id = $user_id AND books_codes.user_code !=0
                WHERE books.id IN (1,3,4,5,6,8) 
                AND books.status = '1' ";
    } else if ($books_idd == 19) {
        $qry = "SELECT DISTINCT  books.*, books_codes.user_code AS bk, books_codes.status AS bcs
                FROM books
                LEFT JOIN books_codes ON books.id = books_codes.book_id AND books_codes.user_id = $user_id AND books_codes.user_code !=0
                WHERE books.id IN (6,17,1,4,8,13,14,5)
                AND books.status = '1' ";
    }

    if ($qry != "") {
        $result = $con->query($qry);
        $data = array(); // Initialize an empty array to hold the data
        $msgbar = "";
        while($row = $result->fetch_assoc()) {
            $row['price'] = $price; 
            $data[] = $row;
            if ($row['bcs'] == 0) {
                $msgbar = "pending";
            }
        }

        echo json_encode(array("heading" => "All books", "type" => "all-books", "msgbar" => $msgbar, "price" => $price, "data" => $data));
    } else {
        echo json_encode(array("heading" => "All bookssss", "type" => "all-books", "price" => $price, "data" => [], "bookBundle"=>$_POST['bookBundle'], "books_idd"=>$books_idd));
    }

} elseif ($spec_id == 3) {  // all mocks
    $qry = "";
    if ($mock_idd == 11) {
        $qry = "SELECT books.*, books_codes.user_code AS bk, books_codes.status AS bcs
                FROM books
                LEFT JOIN books_codes ON books.id = books_codes.book_id AND books_codes.user_id = $user_id AND books_codes.user_code !=0
                WHERE books.id IN (2, 7, 9)
                AND books.status = '1' ";
    } else if ($mock_idd == 20) {
        $qry = "SELECT books.*, books_codes.user_code AS bk, books_codes.status AS bcs
                FROM books
                LEFT JOIN books_codes ON books.id = books_codes.book_id AND books_codes.user_id = $user_id  AND books_codes.user_code !=0
                WHERE books.id IN (7, 9, 12, 15, 16, 18)
                AND books.status = '1' ";
    }

    if ($qry != "") {
        $result = $con->query($qry);
        $data = array(); // Initialize an empty array to hold the data
        $msgbar = "";
        while($row = $result->fetch_assoc()) {
            $row['price'] = $price; 
            $data[] = $row;
            if ($row['bcs'] == 0) {
                $msgbar = "pending";
            }
        }

        echo json_encode(array("heading" => "All Mocks Test", "type" => "all-mock", "msgbar" => $msgbar, "price" => $mock_price, "data" => $data));
    } else {
       echo json_encode(array("heading" => "All Mocks Test", "type" => "all-mock", "msgbar" => $msgbar, "price" => $mock_price, "data" => []));
    }

} elseif ($spec_id == 1) {   // books
    // fetching books
    $qry = "SELECT DISTINCT books.*, books_codes.user_code AS bk, books_codes.status AS bcs
    FROM books
LEFT JOIN books_codes 
  ON books.id = books_codes.book_id 
  AND books_codes.user_id = 4416 
  AND books_codes.user_code != 0 
WHERE books.status = '1';
  ";
    $result = $con->query($qry);
    $data = array(); // Initialize an empty array to hold the data
    while($row = $result->fetch_assoc()) {
        $data[] = $row; // Add the book data to the main data array
    }

    echo json_encode(array("heading" => $rows['spec_name'], "type" => "individuals", "data" => $data));
} else {
    echo json_encode(array("heading" => $rows['spec_name'], "type" => "", "data" => []));
}
?>
