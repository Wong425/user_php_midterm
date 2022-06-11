<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}
include_once("dbconnect.php");
     $sqltutors = "SELECT * FROM tbl_subjects";


     $results_per_page = 5;
     if (isset($_GET['pageno'])) {
          $pageno = (int)$_GET['pageno'];
         $page_first_result = ($pageno - 1) * $results_per_page;
     } else {
          $pageno = 1;
         $page_first_result = 0;
     }

$stmt = $conn->prepare($sqltutors);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqltutors = $sqltutors . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqltutors);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$conn= null;

function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
?>