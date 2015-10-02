<?php

    require_once('loader.php');

    if(isset($_POST['studentSubmitButton']) && $_POST['studentSubmitButton'] == 'Add Student') {
        $studentBllObj = new StudentBLL();
        $newStudent = new StudentDTO(0, $_POST['studentRoll'], $_POST['studentName'], $_POST['studentEmail'], $_POST['studentDateOfBirth']);
        $addStudentResult = $studentBllObj->AddStudent($newStudent);

        if($addStudentResult > 0) {
            $log->info("Student Data inserted.");
            header("Location: edit.php?id=".$addStudentResult);
        }
    }

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Student Information :: Add</title>
</head>
<body>

    <ul>
        <li><a href="add.php">Add</a></li>
        <li><a href="search.php">Search</a></li>
    </ul>

    <?php if(isset($addStudentResult) && $addStudentResult == 0) : ?>
    <div style="color:red;font-weight:bold;">Add failed.</div>
    <?php endif; ?>

    <form action="add.php" method="post" name="studentInfoForm" id="studentInfoForm">
        <label>Name : <input type="text" value="" name="studentName" id="studentName"></label><br />
        <label>Roll : <input type="text" value="" name="studentRoll" id="studentRoll"></label><br />
        <label>Email : <input type="text" value="" name="studentEmail" id="studentEmail"></label><br />
        <label>Date Of Birth : <input type="text" value="" name="studentDateOfBirth" id="studentDateOfBirth"></label><br />
        <input type="submit" name="studentSubmitButton" id="studentSubmitButton" value="Add Student">
    </form>

</body>
</html>