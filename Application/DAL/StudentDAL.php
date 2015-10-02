<?php
/**
 * User: Arif Uddin
 * Date: 4/6/12
 * Time: 4:46 PM
 */

/**
 * Class for database interaction
 *
 *
 */
class StudentDAL {

    private $db;
    private $databaseConnectionObj;

    /**
     * Connect to the database
     * No Parameters
     *
     */
    public function StudentDAL() {
        $this->databaseConnectionObj = new DatabaseConnection();
        $this->db = $this->databaseConnectionObj->GetDB();

    }

    /**
     * Get All students
     * No Parameters
     *
     * @return array
     */
    public function GetAllStudents() {

        $listOfStudentDto = array();
        $sql = "SELECT * FROM Student";
        $raw_result = $this->db->get_results($sql, ARRAY_A);

        if(count($raw_result) > 0){
            for($i=0; $i<count($raw_result); $i++) {

                $id = $raw_result[$i]['Id'];
                $roll = $raw_result[$i]['Roll'];
                $name = $raw_result[$i]['Name'];
                $email = $raw_result[$i]['Email'];
                $dateOfBirth = $raw_result[$i]['DateOfBirth'];
                
                $listOfStudentDto[] = new StudentDTO($id, $roll, $name, $email, $dateOfBirth);
            }
        }

        return $listOfStudentDto;
    }

    /**
     * Get a student
     * @param $studentId
     * @return bool|\StudentDTO
     */
    public function GetStudent($studentId) {
        $sql = "SELECT * FROM Student WHERE Id=". $studentId ." LIMIT 1";
        $aStudent = $this->db->get_row($sql, ARRAY_A);

        if(is_array($aStudent) && count($aStudent) > 0) {
            $studentDtoObj = new StudentDTO($aStudent['Id'], $aStudent['Roll'], $aStudent['Name'], $aStudent['Email'], $aStudent['DateOfBirth']);
            return $studentDtoObj;
        }

        return false;
    }

    /**
     * Insert New Student
     * @param $studentDto
     * @return last insert id
     */
    public function AddStudent($studentDto) {

        $sql = "INSERT INTO Student (`Roll`, `Name`, `Email`, `DateOfBirth`)
                VALUES ('". $studentDto->GetRoll() ."', '". $studentDto->GetName() ."', '". $studentDto->GetEmail() ."', '". $studentDto->GetDateOfBirth() ."')";
        $this->db->query($sql);

        return $this->db->insert_id;
    }

    /**
     * Updates existing Student
     * @param $studentDto
     * @return bool|int
     */
    public function UpdateStudent($studentDto) {

        $sql = "UPDATE Student
                SET
                    Roll='". $studentDto->GetRoll() ."',
                    Name='". $studentDto->GetName() ."',
                    Email='". $studentDto->GetEmail() ."',
                    DateOfBirth='". $studentDto->GetDateOfBirth() ."'
                WHERE Id=". $studentDto->GetId() ." LIMIT 1";

        return $this->db->query($sql);
    }

    /**
     * Search Student By Name
     * @param $studentDto
     * @return array
     */
    public function SearchStudentByName($studentDto) {
        $sql = "SELECT * FROM student WHERE Name LIKE '%".$studentDto->GetName()."%'";
        $searchStudent = $this->db->get_results($sql, ARRAY_A);
        $listOfStudentDto = array();
        if(count($searchStudent) > 0){
            for($i=0; $i<count($searchStudent); $i++) {

                $id = $searchStudent[$i]['Id'];
                $roll = $searchStudent[$i]['Roll'];
                $name = $searchStudent[$i]['Name'];
                $email = $searchStudent[$i]['Email'];
                $dateOfBirth = $searchStudent[$i]['DateOfBirth'];

                $listOfStudentDto[] = new StudentDTO($id, $roll, $name, $email, $dateOfBirth);
            }
        }

        return $listOfStudentDto;

    }

    /**
     * Deletes a student from the database
     * @param $studentDto
     * @return bool|int
     */
    public function DeleteAStudent($studentDto) {

        $sql = "DELETE FROM Student WHERE Id=". $studentDto->GetId() ." LIMIT 1";

        return $this->db->query($sql);
    }

    /**
     * checks whether given Roll exists or not
     *
     * @param $roll
     * @param int $id
     * @return bool
     */
    public function IfRollExists($roll, $id=0) {

        $sql = "SELECT * FROM Student WHERE Roll='". $roll ."' AND Id != $id LIMIT 1";
        $raw_result = $this->db->get_row($sql, ARRAY_A);

        if( count($raw_result) > 0 ) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * checks whether given Id exists or not
     *
     * @param $id
     * @return bool
     */
    public function IfIdExists($id) {

        $sql = "SELECT * FROM Student WHERE Id == $id LIMIT 1";
        $raw_result = $this->db->get_row($sql, ARRAY_A);

        if( count($raw_result) > 0 ) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * checks whether given Email exists or not
     *
     * @param $email
     * @param int $id
     * @return bool
     */
    public function IfEmailExists($email, $id=0) {

        $sql = "SELECT * FROM Student WHERE Email='". $email ."' AND Id != $id LIMIT 1";
        $raw_result = $this->db->get_row($sql, ARRAY_A);

        if( count($raw_result) > 0 ) {
            return true;
        } else {
            return false;
        }

    }
}