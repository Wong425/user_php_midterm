<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$email = $_POST['email'];
$password = sha1($_POST['passw']);
$sqllogin = "SELECT * FROM login_db WHERE email = '$email' AND passw= '$password'";
$result = $conn->query($sqllogin);
$numrow = $result->num_rows;

if ($numrow > 0) {
    while ($row = $result->fetch_assoc()) {
        $customer['id'] = $row['id'];
        $customer['email'] = $row['email'];
        $customer['passw'] = $row['passw'];
        $customer['name'] = $row['name'];
        $customer['phoneNo'] = $row['phone'];
        $customer['address'] = $row['address'];
    }
    $response = array('status' => 'success', 'data' => $client);
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