<?php
/**
 * User: Arif Uddin
 * Date: 10/5/2015
 * Time: 10:17 PM
 *
 * This page returns all students information in JSON format
 */

include_once('../loader.php');

$studentBllObj = new StudentBLL();
$allStudents = $studentBllObj->GetAllStudents();

$json_var = json_encode($allStudents);
echo $json_var;