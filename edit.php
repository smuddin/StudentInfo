<?php

require_once('loader.php');

if(isset($_POST['studentSubmitButton']) && $_POST['studentSubmitButton'] == 'Save') {

    $studentBllObj = new StudentBLL();
    $aStudent = new StudentDTO($_POST['studentId'], $_POST['studentRoll'], $_POST['studentName'], $_POST['studentEmail'], $_POST['studentDateOfBirth']);
    $updateResult = $studentBllObj->UpdateStudent($aStudent);

    if($updateResult > 0) {
        $log->info("Student Data updated.");
        header("Location: edit.php?id=". $aStudent->GetId() ."&update=success");
    } else {
        $log->info("Student Data update attempt failed.");
        header("Location: edit.php?id=". $aStudent->GetId() ."&update=failed");
    }

} elseif(isset($_GET['id']) && (int)$_GET['id'] >0) {

    $studentId = (int)$_GET['id'];

    $studentBllObj = new StudentBLL();
    $aStudent = $studentBllObj->GetStudent($studentId);

} else {
    header("Location: index.php");
}


?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Student Information :: Edit</title>
</head>
<body>

    <ul>
        <li><a href="add.php">Add</a></li>
        <li><a href="search.php">Search</a></li>
    </ul>

    <form action="edit.php" method="post" name="studentInfoForm" id="studentInfoForm">

        <label>Name : <input type="text" value="<?php echo $aStudent->GetName(); ?>" name="studentName" id="studentName"></label><br />
        <label>Roll : <input type="text" value="<?php echo $aStudent->GetRoll(); ?>" name="studentRoll" id="studentRoll"></label><br />
        <label>Email : <input type="text" value="<?php echo $aStudent->GetEmail(); ?>" name="studentEmail" id="studentEmail"></label><br />
        <label>Date Of Birth : <input type="text" value="<?php echo $aStudent->GetDateOfBirth(); ?>" name="studentDateOfBirth" id="studentdateofbirth"></label><br />

        <input type="hidden" value="<?php echo $aStudent->GetId(); ?>" name="studentId" id="studentId" />
        <input type="submit" name="studentSubmitButton" id="studentSubmitButton" value="Save">

    </form>

</body>
</html>