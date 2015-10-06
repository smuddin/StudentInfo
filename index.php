<?php

require_once('loader.php');

if( isset($_GET['delete']) && $_GET['delete']=='yes' ) {

    $studentBllObj = new StudentBLL();
    $deleteAStudent = new StudentDTO($_GET['id'], '', '', '', '');
    $deleteStudent = $studentBllObj->DeleteAStudent($deleteAStudent);

    if($deleteStudent > 0) {
        $log->info("Student Data deleted.");
        header("Location: index.php");
    }
}

$page_title = "Student Information";
include_once("Templates/header.php");

?>

<div class="page-header">
    <h1>List of Students</h1>
</div>


<table class="table table-bordered">
    <thead><tr>
        <th>#</th>
        <th>Name</th>
        <th>Roll</th>
        <th>Email</th>
        <th>Date of Birth</th>
        <th class="center" colspan="2">Action</th>
    </tr></thead>
    <tbody>
        <tr ng-repeat="student in studentList">
            <td>{{ $index + 1 }}</td>
            <td>{{ student.name }}</td>
            <td>{{ student.roll }}</td>
            <td>{{ student.email }}</td>
            <td>{{ student.dateOfBirth }}</td>
            <td class="center"><a href="edit.php?id={{ student.id }}">Edit</a></td>
            <td class="center"><a onclick="return confirm('Do you really want to delete this record?')" href="index.php?id={{ student.id }}&delete=yes">Delete</a></td>
        </tr>
    </tbody>
</table>

<?php include_once("Templates/footer.php"); ?>