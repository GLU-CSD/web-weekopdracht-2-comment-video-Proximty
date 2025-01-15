<?php

include 'index.php';

$sql = "INSERT INTO `reactions` ('Name',Comments)
VALUES ('Submit')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();