<?php
// delete.php
// Menghubungkan dengan database
include('config.php');

$id = $_GET['id'];
$sql = "DELETE FROM games WHERE id=$id";

if(mysqli_query($conn, $sql)){
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>
