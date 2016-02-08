<?php

require_once('loader.php');

$studentBllObj = new StudentBLL();
$allStudents = $studentBllObj->GenerateHtmlForAllStudents();

if( isset($_GET['delete']) && $_GET['delete']=='yes' ) {

    $deleteAStudent = new StudentDTO($_GET['id'], '', '', '', '');
    $deleteStudent = $studentBllObj->DeleteAStudent($deleteAStudent);

    if($deleteStudent > 0) {
        header("Location: index.php");
    }
}

$page_title = "Student Information";
include_once("Templates/header.php");

?>

<div class="page-header">
    <h1>List of Students</h1>
</div>


<?php

echo $allStudents;

include_once("Templates/footer.php");

?>