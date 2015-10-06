<?php
/**
 * User: Arif Uddin
 * Date: 4/6/12
 * Time: 4:32 PM
 */

class StudentBLL {

    private $studentDal;

    public function StudentBLL() {
        $this->studentDal = new StudentDAL();
    }

    public function GetAllStudents() {
        return $this->studentDal->GetAllStudents();
    }

    public function GetStudent($studentId) {

        if($studentId <= 0) {
            // TODO: return type should be same datatype
            return false;
        }
        
        return $this->studentDal->GetStudent($studentId);
    }

    public function GenerateHtmlForAllStudents() {

        $all_students_html = '';
        $all_students = $this->GetAllStudents();

        if( count($all_students) > 0 ) {

            $all_students_html .= '<table class="table table-bordered">';

                $all_students_html .= '<tr>';
                    $all_students_html .= '<th>Name</th>';
                    $all_students_html .= '<th>Roll</th>';
                    $all_students_html .= '<th>Email</th>';
                    $all_students_html .= '<th>Date of Birth</th>';
                    $all_students_html .= '<th class="center" colspan="2">Action</th>';
                $all_students_html .= '</tr>';

            foreach($all_students as $student) {
                $all_students_html .= '<tr>';
                    $all_students_html .= '<td>'. $student->GetName() .'</td>';
                    $all_students_html .= '<td>'. $student->GetRoll() .'</td>';
                    $all_students_html .= '<td>'. $student->GetEmail() .'</td>';
                    $all_students_html .= '<td>'. $student->GetDateOfBirth() .'</td>';
                    $all_students_html .= '<td class="center"><a href="edit.php?id='. $student->GetId() .'">Edit</a></td>';
                    $all_students_html .= '<td class="center"><a onclick="return confirm(\'Do you really want to delete this record?\')" href="index.php?id='. $student->GetId() .'&delete=yes">Delete</a></td>';
                $all_students_html .= '</tr>';
            }

            $all_students_html .= '</table>';

        } else {
            $all_students_html = '<div class="alert alert-warning" role="alert">No student found. Try add some.</div>';
        }

        return $all_students_html;
    }

    public function SearchStudentByName($studentDto){
        return $this->studentDal->SearchStudentByName($studentDto);
    }

    public function GenerateHtmlForSearchStudentByName($studentDto) {

        $all_students_html = '';
        $search_student = $this->SearchStudentByName($studentDto);

        if( count($search_student) > 0 ) {

            $all_students_html .= '<table class="table table-bordered">';

                $all_students_html .= '<tr>';
                    $all_students_html .= '<th>Name</th>';
                    $all_students_html .= '<th>Roll</th>';
                    $all_students_html .= '<th>Email</th>';
                    $all_students_html .= '<th>Date of Birth</th>';
                    $all_students_html .= '<th class="center" colspan="2">Action</th>';
                $all_students_html .= '</tr>';

            foreach($search_student as $student) {
                $all_students_html .= '<tr>';
                    $all_students_html .= '<td>'. $student->GetName() .'</td>';
                    $all_students_html .= '<td>'. $student->GetRoll() .'</td>';
                    $all_students_html .= '<td>'. $student->GetEmail() .'</td>';
                    $all_students_html .= '<td>'. $student->GetDateOfBirth() .'</td>';
                    $all_students_html .= '<td class="center"><a href="edit.php?id='. $student->GetId() .'">Edit</a></td>';
                    $all_students_html .= '<td class="center"><a href="index.php?id='. $student->GetId() .'&delete=yes">Delete</a></td>';
                $all_students_html .= '</tr>';
            }

            $all_students_html .= '</table>';
        }

        return $all_students_html;
    }

    public function AddStudent($studentDto) {

        $insertedId = 0;

        if($studentDto->GetName() == '' || $studentDto->GetRoll() == '' || $studentDto->GetEmail() == '') {
            return $insertedId;
        }

        if( $this->IsValidStudent($studentDto) ) {
            $insertedId = (int)$this->studentDal->AddStudent($studentDto);
        }

        return $insertedId;
    }

    public function UpdateStudent($studentDto) {

        $affectedRows = 0;

        if($studentDto->GetName() == '' || $studentDto->GetRoll() == '' || $studentDto->GetEmail() == '') {
            return $affectedRows;
        }

        if( $this->IsValidStudent($studentDto) ) {
            $affectedRows = (int)$this->studentDal->UpdateStudent($studentDto);
        }

        return $affectedRows;
    }

    public function SearchStudent($studentDto) {

        $affectedRows = 0;

        if($studentDto->GetName() == '') {
            return $affectedRows;
        } else {
            $affectedRows = $this->GenerateHtmlForSearchStudent($studentDto);
        }

        return $affectedRows;
    }

    public function DeleteAStudent($studentDto) {

        $affectedRows = 0;

        if($studentDto->GetId() == '') {
            return $affectedRows;
        }

        if( $this->IsValidStudent($studentDto) ) {
            $affectedRows = (int)$this->studentDal->DeleteAStudent($studentDto);
        }

        return $affectedRows;
    }

    public function IsValidStudent($studentDto) {
        if($this->IfRollExists($studentDto->GetRoll(), $studentDto->GetId()) || $this->IfEmailExists($studentDto->GetEmail(), $studentDto->GetId()) || $this->IfIdExists($studentDto->GetId())) {
            return false;
        } else {
            return true;
        }
    }

    public function IfIdExists($id) {
        return $this->studentDal->IfIdExists($id);
    }

    public function IfRollExists($roll, $id) {
        return $this->studentDal->IfRollExists($roll, $id);
    }

    public function IfEmailExists($email, $id) {
        return $this->studentDal->IfEmailExists($email, $id);
    }
}
