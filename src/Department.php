<?php

    class Department
    {

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO departments (name) VALUES ('{$this->getName()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);

        }

        static function getAll()
        {
            $all_departments = $GLOBALS['DB']->query("SELECT * FROM departments");
            $returned_departments = array();

            foreach($all_departments as $department){
                $name = $department['name'];
                $id = $department['id'];
                $department = new Department($name, $id);
                array_push($returned_departments, $department);
            }
            return $returned_departments;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM departments *;");
        }

        static function find($search_id)
        {
            $found_department = null;
            $departments = Department::getAll();
            foreach($departments as $department){
                if($department->getId() == $search_id){
                    $found_department = $department;
                }
            }
            return $found_department;
        }

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE departments SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM departments WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM students_departments WHERE departments_id = {$this->getId()};");

        }

        function addStudent($student)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_departments (departments_id, students_id) VALUES ({$this->getId()}, {$student->getId()});");
        }

        function addMajor($major)
        {
            $GLOBALS['DB']->exec("INSERT INTO majors (departments_id) VALUES ({$this->getId()});");
        }

        function addCourse($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (departments_id) VALUES ({$this->getId()});");
        }

        function getStudents()
        {
            $query = $GLOBALS['DB']->query("SELECT students.* FROM
                departments JOIN students_departments ON (departments.id = students_departments.departments_id)
                JOIN students ON (students_departments.students_id = students.id)
                WHERE departments.id={$this->getId()};");
            $students_in_department = array();
            if(!empty($query)){
                foreach($query as $student) {
                    $name = $student['name'];
                    $id = $student['id'];
                    $enroll_date = $student['enrollment_date'];
                    $new_student = new Student($name, $id, $enroll_date);
                    array_push($students_in_department, $new_student);
                }
            }
            return $students_in_department;
        }

        function getMajors()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM majors WHERE departments_id = {$this->getId()};");
            $majors_in_department = array();
            foreach($query as $major){
                $name = $major['name'];
                $id = $major['id'];
                $department_id = $major['departments_id'];
                $new_major = new Major($name, $id, $department_id);
                array_push($majors_in_department, $new_major);
            }
            return $majors_in_department;
        }


    }

?>
