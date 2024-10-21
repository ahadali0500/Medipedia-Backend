<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include("connection.php");
$slug = $_POST['slug'];
$user_id = $_POST['user_id'];
$username = $_POST['user_name'];
$useremail = $_POST['user_email'];

$userno = $_POST['user_no'];
$usermac = "";
$date=date('m/d/y');

if ($slug=="book-bundle-1") {
    $qryy = "SELECT * FROM books WHERE id  IN (1,3,4,5,6,8)  AND status !='0'";
    $ress = mysqli_query($con,$qryy);
    $missing_book_ids = [];
    while($dd=mysqli_fetch_assoc($ress)){
        $book_id=$dd['id'];
        $qry = "SELECT * FROM books_codes WHERE user_id = '$user_id' AND book_id = '$book_id'";
        $res = mysqli_query($con, $qry);
        $ddd=mysqli_fetch_assoc($res);
       
        if (!mysqli_num_rows($res)>0) {
            $query = "INSERT INTO books_codes (`id`, `book_id`, `user_id`, `user_name`, `user_email`, `user_no`, `user_code`, `user_mac`, `date`, `status`, `type`)
            VALUES (NULL, '$book_id', '$user_id', '$username', '$useremail', '$userno', 0, '$usermac', '$date', '', -1);";
            $result = mysqli_query($con, $query);
            $missing_book_ids[] = $book_id;
        }else{
            $idd=$ddd['id'];
            if($ddd['user_code']==0 || $ddd['user_code']==""){
                $ddd="UPDATE `books_codes` SET `type`= -1 WHERE `id`='$idd'";
                mysqli_query($con, $ddd);
            }
        }
    }
    $arr=[];
    if (empty($missing_book_ids)) {
        $arr['Success']="Already";
    }else{
        $arr['Success']="true";
    }  
    
    print_r(json_encode($arr));

}elseif ($slug=="book-bundle-2") {

    $qryy = "SELECT * FROM books WHERE id IN (6,17,1,4,8,13,14,5) AND status != '0'";
    $ress = mysqli_query($con,$qryy);
    $missing_book_ids = [];
    while($dd=mysqli_fetch_assoc($ress)){
        $book_id=$dd['id'];
        $qry = "SELECT * FROM books_codes WHERE user_id = '$user_id' AND book_id = '$book_id'";
        $res = mysqli_query($con, $qry);
        $ddd=mysqli_fetch_assoc($res);
       
        if (!mysqli_num_rows($res)>0) {
            $query = "INSERT INTO books_codes (`id`, `book_id`, `user_id`, `user_name`, `user_email`, `user_no`, `user_code`, `user_mac`, `date`, `status`, `type`)
            VALUES (NULL, '$book_id', '$user_id', '$username', '$useremail', '$userno', 0, '$usermac', '$date', '', -3)";
            $result = mysqli_query($con, $query);
            $missing_book_ids[] = $book_id;
        }else{
            $idd=$ddd['id'];
            if($ddd['user_code']==0 || $ddd['user_code']==""){
                $ddd="UPDATE `books_codes` SET `type`= -3 WHERE `id`='$idd'";
                mysqli_query($con, $ddd);
            }
        }
    }
    $arr=[];
    if (empty($missing_book_ids)) {
        $arr['Success']="Already";
    }else{
        $arr['Success']="true";
    }  
    
    print_r(json_encode($arr));
    
}elseif ($slug=="mock-bundle-1") {

    $qryy = "SELECT * FROM books WHERE id IN (2, 7, 9) AND status != '0'";
    $ress = mysqli_query($con,$qryy);
    $missing_book_ids = [];
    while($dd=mysqli_fetch_assoc($ress)){
        $book_id=$dd['id'];
        $qry = "SELECT * FROM books_codes WHERE user_id = '$user_id' AND book_id = '$book_id'";
        $res = mysqli_query($con, $qry);
        $ddd=mysqli_fetch_assoc($res);
       
        if (!mysqli_num_rows($res)>0) {
            $query = "INSERT INTO books_codes (`id`, `book_id`, `user_id`, `user_name`, `user_email`, `user_no`, `user_code`, `user_mac`, `date`, `status`, `type`)
            VALUES (NULL, '$book_id', '$user_id', '$username', '$useremail', '$userno', 0, '$usermac', '$date', '', -2);";
            $result = mysqli_query($con, $query);
            $missing_book_ids[] = $book_id;
        }else{
            $idd=$ddd['id'];
            if($ddd['user_code']==0 || $ddd['user_code']==""){
                $ddd="UPDATE `books_codes` SET `type`= -2 WHERE `id`='$idd'";
                mysqli_query($con, $ddd);
            }
        }
    }
    $arr=[];
    if (empty($missing_book_ids)) {
        $arr['Success']="Already";
    }else{
        $arr['Success']="true";
    }  
    
    print_r(json_encode($arr));
    
}elseif ($slug=="mock-bundle-2") {

    $qryy = "SELECT * FROM books WHERE id IN (7, 9, 12, 15, 16, 18) AND status != '0'";
    $ress = mysqli_query($con,$qryy);
    $missing_book_ids = [];
    while($dd=mysqli_fetch_assoc($ress)){
        $book_id=$dd['id'];
        $qry = "SELECT * FROM books_codes WHERE user_id = '$user_id' AND book_id = '$book_id'";
        $res = mysqli_query($con, $qry);
        $ddd=mysqli_fetch_assoc($res);
       
        if (!mysqli_num_rows($res)>0) {
            $query = "INSERT INTO books_codes (`id`, `book_id`, `user_id`, `user_name`, `user_email`, `user_no`, `user_code`, `user_mac`, `date`, `status`, `type`)
            VALUES (NULL, '$book_id', '$user_id', '$username', '$useremail', '$userno', 0, '$usermac', '$date', '', -4)";
            $result = mysqli_query($con, $query);
            $missing_book_ids[] = $book_id;
        }else{
            $idd=$ddd['id'];
            if($ddd['user_code']==0 || $ddd['user_code']==""){
                $ddd="UPDATE `books_codes` SET `type`= -4 WHERE `id`='$idd'";
                mysqli_query($con, $ddd);
            }
        }
    }
    $arr=[];
    if (empty($missing_book_ids)) {
        $arr['Success']="Already";
    }else{
        $arr['Success']="true";
    }  
    
    print_r(json_encode($arr));
    
}else{

    $qryy = "SELECT * FROM books WHERE slug = '$slug'";
    $ress = mysqli_query($con,$qryy);
    $dd=mysqli_fetch_assoc($ress);
    $book_id=$dd['id'];

    $qry = "SELECT * FROM books_codes WHERE user_id = '$user_id' and book_id = '$book_id'";
    $res = mysqli_query($con,$qry);

    if(mysqli_num_rows($res)>0)
    {
        $arr["Success"] = "Already";
        print(json_encode($arr));
    }
    else{

        $query = "INSERT INTO books_codes(id,book_id,user_id,user_name,user_email,user_no,user_code,user_mac,status,type)
        VALUES(NULL,'$book_id','$user_id','$username','$useremail','$userno',0,'$usermac','',0)";
        $result = mysqli_query($con,$query);

        $arr = [];
        if($result)
        {
            $arr["Success"] = "true";
        }
        else
        {
            $arr["Success"] = "false";
        }
        print(json_encode($arr));
    }

}


?>