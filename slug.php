<?php

function generateSlug($string) {
    // Convert the string to lowercase
    $slug = strtolower($string);
    
    // Replace spaces with hyphens
    $slug = str_replace(' ', '-', $slug);
    
    // Remove special characters
    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
    
    // Remove consecutive hyphens
    $slug = preg_replace('/-+/', '-', $slug);
    
    // Trim hyphens from the beginning and end
    $slug = trim($slug, '-');
    
    return $slug;
}

function slugExists($con, $slug) {
    $qry = "SELECT COUNT(*) as count FROM test WHERE slug = '$slug'";
    $result = $con->query($qry);
    if (!$result) {
        throw new Exception("Database query failed: " . $con->error);
    }
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

include("connection.php");

try {
    $qry = "SELECT * FROM test";
    $result = $con->query($qry);
    if (!$result) {
        throw new Exception("Database query failed: " . $con->error);
    }

    while ($row = $result->fetch_assoc()) {
        $baseSlug = generateSlug($row['test_name']);
        $slug = $baseSlug;
        $id = $row['id'];

        $suffix = 0;
        while (slugExists($con, $slug)) {
            $suffix++;
            $slug = $baseSlug . '-' . $suffix;
        }

        $vv = "UPDATE `test` SET `slug`='$slug' WHERE id=$id";
        if (!$con->query($vv)) {
            throw new Exception("Database update failed: " . $con->error);
        }
    }
} catch (Exception $e) {
    // Log the error (you can also write to a file or use an error logging system)
    error_log($e->getMessage());
    // Display a user-friendly message
    echo "An error occurred while processing your request. Please try again later.";
}

?>
