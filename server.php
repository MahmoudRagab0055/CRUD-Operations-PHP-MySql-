<?php
session_start();

//connect to the database
$db = mysqli_connect("localhost","root","","CRUD");

// initialize variables
$name = "";
$address = "";
$id = 0;
$edit_state = false;

//if save button is clicked
if(isset($_POST['save'])){

$name = $_POST['name'];
$address = $_POST['address'];
$query = "INSERT INTO info (name, address) VALUES('$name', '$address')";

mysqli_query($db, $query);

$_SESSION['msg'] = "Record Inserted";

header('location: index.php'); //redirect to index.php page
}
// fetch the record to be updated
//edit is clicked
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit_state = true;
    $rec = mysqli_query($db, "SELECT * FROM info WHERE $id = id;");
    $record = mysqli_fetch_array($rec);
    $id = $record['id'];
    $name = $record['name'];
    $address = $record['address'];
    }

// update records
if (isset($_POST['update'])){
    $name = $db -> real_escape_string($_POST['name']);
    $address = $db -> real_escape_string($_POST['address']);
    $id = $db -> real_escape_string($_POST['id']);
    $query = "UPDATE info SET name = $name, address = $address WHERE id = $id";
    mysqli_query($db, $query);
    $_SESSION['msg'] = "Record Updated";
    header('location: index.php');
}

//delete records
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM info WHERE id=$id";
    mysqli_query($db, $query);
    $_SESSION['msg'] = "Record Deleted";
    header('location: index.php');
}

// retrieve records
$results = mysqli_query($db, "SELECT * FROM info");
?>