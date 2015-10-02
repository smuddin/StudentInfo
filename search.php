<?php
    require_once('loader.php');

    $searchResult = array();
    $message = '';
    if(isset($_POST['studentSubmitButton']) && $_POST['studentSubmitButton'] == 'Search') {

        $studentBllObj = new StudentBLL();
        $searchStudentByName = new StudentDTO(0, '', $_POST['studentName'], '', '');
        $searchResult = $studentBllObj->GenerateHtmlForSearchStudentByName($searchStudentByName);
        if(count($searchResult) == 0) $message = "No Result Found.";

    }

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Student Information :: Home</title>
</head>
<body>
<form action="search.php" method="post" name="studentSearchForm" id="studentSearchForm">
    <label>Name : <input type="text" value="" name="studentName" id="studentName"></label>
    <input type="submit" name="studentSubmitButton" id="studentSubmitButton" value="Search">
</form><br />
<?php
    if(count($searchResult) > 0) {
        echo $searchResult;
    } else {
        echo $message;
    }
?>
</body>
</html>