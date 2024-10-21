<?php 
      // Define database connection parameters

      //   $dbhost = 'localhost';
      // $dbuser = 'uhlpip1nygtzs'; // Example username
      // $dbpass = 'zgjw7jw8wqfg'; // Example password, seems to be the same as username
      // $dbname = 'dbhhepivzcfuil'; // Example database name

      
       $dbhost = 'localhost';
         $dbuser = 'u4lql9olrzjvw';
         $dbpass = 'Desired@671iez';
         $dbname = 'dbzg1bnlp6izu5';

      // Attempt to connect to the MySQL database
      $con = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

      // The `return` statement here is problematic for a couple of reasons:
      // 1. If used inside a function, it would stop the function execution and return the value of `$con`.
      // 2. Since it's not inside a function, its usage here is incorrect for a script that's meant to check the connection status.
      // So, we'll remove the return statement to continue with the connection check.

      // Check the connection
      if(!$con) {
         // If connection failed, output the error
         die('Could not connect: ' . mysqli_error($con)); // Added `$con` as a parameter to `mysqli_error` for correct error reporting
      } else {
         // If connection is successful, print a success message
        // echo "Connected successfully <br>";
      }

      // The following `echo` would never be reached if the connection fails because of the `die()` function call.
      // It's placed outside the if-else block, so it would execute if the connection is successful, but it's redundant
      // because you already have a success message in the else block.
      // echo 'Connected successfully <br>';
?>
