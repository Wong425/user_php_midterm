<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
$name = addslashes($_POST['name']);
$email= addslashes($_POST['email']);
$password = sha1($_POST['passw']);
$phoneNo = $_POST['phone'];
$address = $_POST['address'];
$base64image = $_POST['image'];
print($name);
$sqlinsert = "INSERT INTO login_db (name, email, passw, phone, address) 
VALUES ('$name','$email','$password','$phoneNo','$address')";
if ($conn->query($sqlinsert) === TRUE) {
    $response = array('status' => 'success', 'data' => null);
    $filename = mysqli_insert_id($conn);
    $decoded_string = base64_decode($base64image1);
    $path = '../assets/profile/' . $filename . '.jpg';
    $is_written = file_put_contents($path, $decoded_string);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>