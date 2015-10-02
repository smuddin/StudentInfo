<?php

require_once('loader.php');

$studentBllObj = new StudentBLL();
$allStudents = $studentBllObj->GenerateHtmlForAllStudents();
if(isset($_GET['delete'])&&$_GET['delete']=='yes') {
    $deleteAStudent = new StudentDTO($_GET['id'], '', '', '', '');
    $deleteStudent = $studentBllObj->DeleteAStudent($deleteAStudent);
    if($deleteStudent > 0) {
        $log->info("Student Data deleted.");
        header("Location: index.php");
    }
}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Student Information :: Home</title>
</head>
<body>

    <ul>
        <li><a href="add.php">Add</a></li>
        <li><a href="search.php">Search</a></li>
    </ul>

    <?php echo $allStudents; ?>

</body>
</html>