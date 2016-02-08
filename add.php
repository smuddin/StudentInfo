<?php

require_once('loader.php');

if( isset($_POST['studentSubmitButton']) && $_POST['studentSubmitButton'] == 'Add Student' ) {

    $studentBllObj = new StudentBLL();
    $newStudent = new StudentDTO(0, $_POST['studentRoll'], $_POST['studentName'], $_POST['studentEmail'], $_POST['studentDateOfBirth']);
    $addStudentResult = $studentBllObj->AddStudent($newStudent);

    if($addStudentResult > 0) {
        header("Location: edit.php?id=".$addStudentResult);
    }
}

$page_title = "Add New Student";
include_once("Templates/header.php");

?>


<div class="page-header">
    <h1>Add a New Student</h1>
</div>


    <form action="add.php" method="post" name="studentInfoForm" id="studentInfoForm" class="form-horizontal">
        <div class="form-group">
            <label for="studentName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" value="" name="studentName" id="studentName" class="form-control" placeholder="Name" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentRoll" class="col-sm-2 control-label">Roll</label>
            <div class="col-sm-4">
                <input type="text" value="" name="studentRoll" id="studentRoll" class="form-control" placeholder="Roll" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
                <input type="email" value="" name="studentEmail" id="studentEmail" class="form-control" placeholder="Email" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentDateOfBirth" class="col-sm-2 control-label">Date Of Birth</label>
            <div class="col-sm-3">
                <input type="text" value="" name="studentDateOfBirth" id="studentDateOfBirth" class="form-control" placeholder="Date Of Birth" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <input type="submit" name="studentSubmitButton" id="studentSubmitButton" value="Add Student" class="btn  btn-primary" />
            </div>
        </div>

    </form>


<?php include_once("Templates/footer.php"); ?>