<?php
    require_once('loader.php');

    $searchResult = array();
    $search_string = '';
    $message = '';

    if(isset($_POST['studentSubmitButton']) && $_POST['studentSubmitButton'] == 'Search') {

        $search_string = $_POST['studentNameSearch'];
        $studentBllObj = new StudentBLL();
        $searchStudentByName = new StudentDTO(0, '', $_POST['studentNameSearch'], '', '');
        $searchResult = $studentBllObj->GenerateHtmlForSearchStudentByName($searchStudentByName);

        if(count($searchResult) == 0) {
            $message = "No student found. Try a different student name.";
        }

    }

$page_title = "Searching Student...";
include_once("Templates/header.php");


?>

    <div class="page-header">
        <h1>Searching Student...</h1>
    </div>

    <?php
        if(count($searchResult) > 0) {
            echo $searchResult;
        } else {
            echo $message;
        }
    ?>

<?php include_once("Templates/footer.php"); ?>