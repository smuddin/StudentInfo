<?php

require_once('loader.php');

if(isset($_POST['studentSubmitButton']) && $_POST['studentSubmitButton'] == 'Update Student') {

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


$page_title = "Edit Student";
include_once("Templates/header.php");


?>

    <div class="page-header">
        <h1>Edit Student</h1>
    </div>


    <form action="edit.php" method="post" name="studentInfoForm" id="studentInfoForm" class="form-horizontal">

        <div class="form-group">
            <label for="studentName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" value="<?php echo $aStudent->GetName(); ?>" name="studentName" id="studentName" class="form-control" placeholder="Name" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentRoll" class="col-sm-2 control-label">Roll</label>
            <div class="col-sm-4">
                <input type="text" value="<?php echo $aStudent->GetRoll(); ?>" name="studentRoll" id="studentRoll" class="form-control" placeholder="Roll" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
                <input type="text" value="<?php echo $aStudent->GetEmail(); ?>" name="studentEmail" id="studentEmail" class="form-control" placeholder="Email" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentDateOfBirth" class="col-sm-2 control-label">Date Of Birth</label>
            <div class="col-sm-3">
                <input type="text" value="<?php echo $aStudent->GetDateOfBirth(); ?>" name="studentDateOfBirth" id="studentDateOfBirth" class="form-control" placeholder="Date Of Birth" />
            </div>
        </div>

        <input type="hidden" value="<?php echo $aStudent->GetId(); ?>" name="studentId" id="studentId" />
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <input type="submit" name="studentSubmitButton" id="studentSubmitButton" value="Update Student" class="btn  btn-primary" />
            </div>
        </div>

    </form>

<?php include_once("Templates/footer.php"); ?>